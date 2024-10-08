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
    ) {
    }

    /**
     * @param string $uriTemplate
     * @param string $controllerClassName
     * @param string $actionMethodName
     * @return void
     * @throws \Exception
     */
    public static function get(string $uriTemplate, string $controllerClassName, string $actionMethodName): void
    {
        $controller = new $controllerClassName($_GET);
        $instance = new self(strtolower($uriTemplate), $controller, $actionMethodName);
        $router = Router::getInstance();
        $router->addGet($instance);
    }


    /**
     * @param string $uriTemplate
     * @param string $controllerClassName
     * @param string $actionMethodName
     * @return void
     * @throws \Exception
     */
    public static function post(string $uriTemplate, string $controllerClassName, string $actionMethodName): void
    {
        $controller = new $controllerClassName($_POST);
        $instance = new self(strtolower($uriTemplate), $controller, $actionMethodName);
        $router = Router::getInstance();
        $router->addPost($instance);
    }


    /**
     * @param string $uriTemplate
     * @param string $controllerClassName
     * @param string $actionMethodName
     * @return void
     * @throws \Exception
     */
    public static function delete(string $uriTemplate, string $controllerClassName, string $actionMethodName): void
    {
        $controller = new $controllerClassName($_REQUEST);
        $instance = new self(strtolower($uriTemplate), $controller, $actionMethodName);
        $router = Router::getInstance();
        $router->addDelete($instance);
    }


    /**
     * @param string $uriTemplate
     * @param string $controllerClassName
     * @param string $actionMethodName
     * @return void
     * @throws \Exception
     */
    public static function patch(string $uriTemplate, string $controllerClassName, string $actionMethodName): void
    {
        $controller = new $controllerClassName($_REQUEST);
        $instance = new self(strtolower($uriTemplate), $controller, $actionMethodName);
        $router = Router::getInstance();
        $router->addPatch($instance);
    }


}