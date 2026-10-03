<?php

class Controller
{
    public function  view($view, $data = []): void
    {
        $controllerPath = __DIR__ . '/../view/' . $view  . '.php';
        require_once($controllerPath);
    }

    public function  model($model): object
    {
        $controllerPath = __DIR__ . '/../models/' . $model  . '.php';
        require_once($controllerPath);
        return new $model;
    }
}
