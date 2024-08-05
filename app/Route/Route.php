<?php

namespace App\Route;

use App\Controllers\ControllerInterface;

class Route
{

    /**
     * @param string $uriTemplate
     * @param ControllerInterface $controller
     * @param string $actionControllerMethod
     */
    public function __construct(
        public readonly string $uriTemplate,
        public readonly ControllerInterface $controller,
        public readonly string $actionControllerMethod
    ){}

    /**
     * @param string $uriTemplate
     * @param string $controllerClassName
     * @param string $actionMethodName
     * @return void
     */
    public static function get(string $uriTemplate, string $controllerClassName, string $actionMethodName): void
    {
        $controller = new $controllerClassName($_GET);
        $instance = new self(strtolower($uriTemplate), $controller, $actionMethodName);
        $router = Router::getInstance();
        $router->addGet($instance);
    }


}