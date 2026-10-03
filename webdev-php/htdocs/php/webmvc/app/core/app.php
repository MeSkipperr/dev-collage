<?php

class App
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        //Controller
        if (file_exists(filename: '../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        $controllerPath = __DIR__ . '/../controllers/' . $this->controller . '.php';

        if (file_exists($controllerPath)) {
            require_once $controllerPath;

            $this->controller = new $this->controller;
        }

        // Method
        if (isset($url[1])) {

            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];

                unset($url[1]);
            }
        }

        // Parameters
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array(
            [$this->controller, $this->method],
            $this->params
        );
    }

    public function parseURL(): array|bool
    {
        if (!isset($_GET['url'])) {
            return false;
        }

        $url = rtrim($_GET['url'], '/');

        $url = filter_var(
            $url,
            FILTER_SANITIZE_URL
        );

        return explode('/', $url);
    }
}
