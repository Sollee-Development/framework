<?php
namespace Config;
class RouteOutput {
    private $router;
    private $dice;
    private $request;
    private $viewData = [];
    private $errorRoute;
    private $defaultModule;

    public function __construct(\Level2\Router\Router $router, Environment $environment, \Level2\Router\Route $errorRoute,
        \Utils\Request $request,
        $defaultModule = "index") {
        $this->router = $router;
        $this->environment = $environment;
        $this->errorRoute = $errorRoute;
        $this->request = $request;
        $this->defaultModule = $defaultModule;
    }

    public function find(array $url = []) {
        $route = $this->getRoute($url);

        if (empty($route->getView())) return;

        $output = $this->addViewData([
            'model' => $route->getModel(),
            'url' => $url,
            'params' => $this->request->get('url')
        ]);

        return $route->getView()->output($this->viewData);
    }

    public function sendHeaders(array $headers) {
        foreach ($headers as list($name, $content)) {
            if ($name === 'status') http_response_code($content);
            else if ($name === 'location' && $content[0] !== '.')
                header($name . ': ' . $this->environment->getRoot() . $content);
            else header($name . ': ' . $content);
        }
    }

    private function getRoute($url, $tryagain = true) {
        try {
            $route = $this->router->find($url);
        }
        catch (\Exception $e) {
            if ($tryagain) {
                array_unshift($url, $this->defaultModule);
                return $this->getRoute($url, false);
            }

            if ($this->environment->getDebug()) var_dump($e);
            // If there is no route
            $route = $this->errorRoute;
        }

        return $route;
    }

    public function addViewData(array $data) {
        $this->viewData = array_merge_recursive($this->viewData, $data);
    }
}
