<?php

namespace App\Core;

class App
{

    public static function run(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

        /**
         * @params $routes array<string, array<string, string>>
         */
        $routes = [
            '/' => [\App\Controller\HomeController::class, 'index'],
            '/contact' => [\App\Controller\ContactController::class, 'contact'],
            '/product' => [\App\Controller\ProductController::class, 'index'],
            '/product/new' => [\App\Controller\ProductController::class, 'new'],
            '/product/{id}/edit' => [\App\Controller\ProductController::class, 'edit'],
            '/product/{slug}/{id}' => [\App\Controller\ProductController::class, 'show'],
            '/product/{id}/delete' => [\App\Controller\ProductController::class, 'delete']
        ];

        // route statique
        if (isset($routes[$path])) {
            [$controllerClass, $methodName] = $routes[$path];

            (new $controllerClass())->$methodName();
            return;
        }

        // route dynamique
        foreach ($routes ?? [] as $route => $target) {
            // Transforme une route du type /user/{id} en regex /user/([^/]+)
            $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $route);
            $pattern = "#^" . $pattern . "$#";

            // Si l’URL correspond
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // retire l'URL complète

                [$controllerClass, $action] = $target;

                // Passe les paramètres au controller en appellant l'action
                (new $controllerClass())->$action(...$matches);
                return;
            }
        }

        http_response_code(404);
        echo '404 Not Found';
    }
}
