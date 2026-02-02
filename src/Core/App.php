<?php

namespace App\Core;

class App {

    public static function run(): void
    {
       $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

       $routes = [
           '/' => 'page home',
           '/contact' => 'page contact',
           '/products' => 'page products'
       ];

       if (isset($routes[$path])) {
           echo $routes[$path];
           return;
       }

       http_response_code(404);
       echo '404 Not Found';
    }
}
