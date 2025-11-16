<?php

namespace Arya\SistemPerpustakaan\Core;

class App {
    private $router;
    private $controller;
    private $method;
    private $params;

    public function __construct() {
        $this->router = new Router();
        $this->router->parseUrl();
        
        // Get routing information from router
        $this->controller = $this->router->getController();
        $this->method = $this->router->getMethod();
        $this->params = $this->router->getParams();
    }

    public function run() {
        // Load controller using autoloader
        $controllerClass = 'Arya\\SistemPerpustakaan\\Controllers\\' . $this->controller . 'Controller';
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass;

            // Call method if exists
            if (method_exists($controller, $this->method)) {
                call_user_func_array([$controller, $this->method], $this->params);
            } else {
                // Default to index method if specified method doesn't exist
                if (method_exists($controller, 'index')) {
                    call_user_func_array([$controller, 'index'], $this->params);
                } else {
                    // If no index method, show 404 or default to auth controller
                    $this->loadDefaultController();
                }
            }
        } else {
            // Default to auth controller if not found
            $this->loadDefaultController();
        }
    }

    private function loadDefaultController() {
        $controllerClass = 'Arya\SistemPerpustakaan\Controllers\AuthController';
        $controller = new $controllerClass;
        // Call method if exists
        if (method_exists($controller, $this->method)) {
            call_user_func_array([$controller, $this->method], $this->params);
        } else {
            // Default to showLoginForm method if specified method doesn't exist
            if (method_exists($controller, 'showLoginForm')) {
                call_user_func_array([$controller, 'showLoginForm'], $this->params);
            }
        }
    }
}