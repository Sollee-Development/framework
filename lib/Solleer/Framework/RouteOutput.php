<?php
namespace Solleer\Framework;
class RouteOutput {
    private $router;
    private $dice;
    private $request;
    private $viewData = [];
    private $errorRoute;
    private $defaultModule;
    private $error = null;

    public function __construct(\Level2\Router\Router $router, Environment $environment, \Level2\Router\Route $errorRoute,
                                \Level2\Core\Request $request,
                                $defaultModule = "index") {
        $this->router = $router;
        $this->environment = $environment;
        $this->errorRoute = $errorRoute;
        $this->request = $request;
        $this->defaultModule = $defaultModule;
    }

    public function find(array $url = []): void {
        $route = $this->getRoute($url);

        if (empty($route->getView())) return;

        $this->addViewData([
            'model' => $route->getModel(),
            'url' => $url,
            'params' => $this->request->get('url')
        ]);

        $output = $route->getView()->output($this->viewData);

        if (!$output) return;

        if ($route->getView() instanceof \Transphporm\Builder) $this->outputTransphporm($output);
    }

    public function outputTransphporm($output): void {
        // If there are headers, Send them
        if (!empty($output->headers)) {
            $this->sendHeaders($output->headers);
            exit;
        }

        echo $output->body;
    }

    public function sendHeaders(array $headers) {
        foreach ($headers as list($name, $content)) {
            if ($name === 'status') http_response_code($content);
            else if ($name === 'location' && $content[0] !== '.' && strpos($content,'http') === false)
                header($name . ': ' . $this->environment->getRoot() . $content);
            else header($name . ': ' . $content);
        }
    }

    private function getRoute($url, $tryagain = true) {
        try {
            $route = $this->router->find($url);
        }
        catch (\Exception $e) {
            if ($this->error === null) $this->error = $e;
            if ($tryagain) {
                array_unshift($url, $this->defaultModule);
                return $this->getRoute($url, false);
            }

            if ($this->environment->getDebug()) var_dump($this->error);
            // If there is no route
            $route = $this->errorRoute;
        }

        return $route;
    }

    public function addViewData(array $data) {
        $this->viewData = array_merge_recursive($this->viewData, $data);
    }
}