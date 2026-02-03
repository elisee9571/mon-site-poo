<?php

namespace App\Core;

abstract class Controller
{
    protected function render(string $view, array $params = []): void
    {
        extract($params);

        require dirname(__DIR__) . '/../template/' . $view . '.php';
    }

    protected function redirect(string $url): void {

        header("HTTP/1.1 301 Moved Permanently");
        header('Location: ' . $url);
        die;
    }
}
