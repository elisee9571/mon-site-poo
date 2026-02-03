<?php

namespace App\Core;

class App {

    public static function run(): void
    {
       $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

        /**
         * @params $routes array<string, array<string, string>>
        */
       $routes = [
           '/' => [\App\Controller\HomeController::class, 'index'],
           '/contact' => [\App\Controller\HomeController::class, 'contact']
       ];

       if (isset($routes[$path])) {
           [$controllerClass, $methodName] = $routes[$path];

           (new $controllerClass())->$methodName();
           return;
       }

       http_response_code(404);
       echo '404 Not Found';
    }
}
