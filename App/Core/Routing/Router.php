<?php

namespace App\Core\Routing;

use \App\Core\Request;
use App\Middleware\GlobalMiddleware;

class Router
{
    private $request;
    private $routes;
    private $current_route;
    const BASE_CONTROLLER = '\App\Controllers\\';

    public function __construct()
    {
        $this->request = new Request();
        $this->routes = Route::routes();
        $this->current_route = $this->findRoute($this->request) ?? null;

        # run middleware
        $this->run_global_middleware();
        $this->run_route_middleware();
    }

    private function run_route_middleware()
    {
        if (is_null($this->current_route))
            return;
            
        $middleware = $this->current_route['middleware'];
        foreach ($middleware as $middleware_class) {
            $middleware_obj = new $middleware_class;
            $middleware_obj->handle();
        }
    }
    private function run_global_middleware()
    {
        $global_middleware = new GlobalMiddleware();
        $global_middleware->handle();
    }

    public function findRoute(Request $request)
    {
        foreach ($this->routes as $route) {
            if (!in_array($request->method(), $route['methods']) && $request->uri())
                continue;

            if ($this->regex_matched($route))
                return $route;
        }
        return null;
    }

    public function regex_matched($route)
    {
        global $request;
        $pattern = '/^' . str_replace(['/', '{', '}'], ['\/', '(?<', '>[-%\w]+)'], $route['uri']) . '$/';
        $result = preg_match($pattern, $this->request->uri(), $matches);
        if (!$result) {
            return false;
        }
        foreach ($matches as $key => $value) {
            if (!is_int($key)) {
                $request->add_route_param($key, $value);
            }
        }
        return true;
    }

    public function dispatch404()
    {
        header("HTTP/1.0 404 Not Found");
        view('errors.404');
        die();
    }

    public function run()
    {
        # Invalid Request Method : 405
        // if($this->invalidRequest($this->request)){
        //   $this->dispatch405();
        // }

        # URI Not Exist : 404
        if (is_null($this->current_route)) {
            $this->dispatch404();
        }

        $this->dispatch($this->current_route);
    }

    private function dispatch($route)
    {
        $action = $route['action'];

        # action : null
        if (is_null($action) || empty($action)) {
            return;
        }

        # action : clousure (anonymous function)
        if (is_callable($action)) {
            call_user_func($action);
        }

        # action : Controller@Method
        if (is_string($action)) {
            $action = explode('@', $action);
        }

        # action : ['Controller', 'Method']
        if (is_array($action)) {
            $class_name = self::BASE_CONTROLLER . $action[0];
            $method = $action[1];
            if (!class_exists($class_name)) {
                throw new \Exception("Class $class_name Not Exists!");
            }
            $controller = new $class_name;
            if (!method_exists($controller, $method))
                throw new \Exception("Method $method Not Exists in Class $class_name!");
            $controller->{$method}();
        }
    }
}
