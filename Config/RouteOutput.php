<?php
namespace Config;
class RouteOutput {
    private $router;
    private $dice;
    private $viewData = [];
    private $errorRoute;

    public function __construct(\Level2\Router\Router $router, \Dice\Dice $dice,
                                Resources $resources, Environment $environment,
                                \Utils\Request $request, \Level2\Router\Route $errorRoute) {
        $this->router = $router;
        $this->dice = $dice;
        $this->environment = $environment;
        $this->errorRoute = $errorRoute;

        $this->addViewData([
            'config' => [
                'environment' => $environment,
                'resources' => $resources
            ],
            'request' => $request
        ]);
    }

    public function find(string $url = ' ') {
        try {
            $route = $router->find(explode('/', $url));
        }
        catch (Exception $e) {
            if ($this->environment->getDebug()) var_dump($e);
            // If there is no route
            $route = $this->errorRoute;
        }

        if (empty($route->getView())) return;

        $output = $this->addViewData([
            'model' => $route->getModel(),
            'url' => explode('/', $url),
            'params' => $url ?? ''
        ]);

        return $route->getView()->output($this->viewData);
    }

    public function sendHeaders(array $headers): void {
        foreach ($headers as list($name, $content)) {
            if ($name === 'status') http_response_code($content);
            else if ($name === 'location' && $content[0] !== '.')
                header($name . ': ' . $this->environment->getRoot() . $content);
            else header($name . ': ' . $content);
        }
    }

    public function addViewData(array $data): void {
        array_merge_recursive($this->viewData, $data);
    }
}
