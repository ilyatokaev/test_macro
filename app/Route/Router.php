<?php

namespace App\Route;

final class Router
{

    private static ?self $singletonSelfInstance = null;

    public array $getRoutes = [];
//    private array $getRoutes = [];
    private array $postRoutes = [];
    private array $patchRoutes = [];
    private array $deleteRoutes = [];


    /**
     * Закрываем конструктор
     */
    private function __construct()
    {
    }

    /**
     * @return Router
     */
    public static function getInstance(): self
    {

        if (null === self::$singletonSelfInstance) {
            self::$singletonSelfInstance = new self();
        }

        return self::$singletonSelfInstance;
    }


    /**
     * @param Route $route
     * @return void
     * @throws \Exception
     */
    public function addGet(Route $route): void
    {
        $requestMethod = 'GET';
        $hashKey = hash('md5', $requestMethod . strtolower($route->uriTemplate));

        if (isset($this->getRoutes[$hashKey])) {
            throw new \Exception('Duplicate ' . $requestMethod . ' route ' . $route->uriTemplate);
        }

        $this->getRoutes[$hashKey] = $route;
    }


    /**
     * @param Route $route
     * @return void
     * @throws \Exception
     */
    public function addPost(Route $route): void
    {
        $requestMethod = 'POST';
        $hashKey = hash('md5', $requestMethod . strtolower($route->uriTemplate));

        if (isset($this->postRoutes[$hashKey])) {
            throw new \Exception('Duplicate ' . $requestMethod . ' route ' . $route->uriTemplate);
        }

        $this->postRoutes[$hashKey] = $route;
    }


    /**
     * @return mixed
     * @throws \Exception
     */
    public function do()
    {

        $targetRoutes = match (strtoupper($_SERVER['REQUEST_METHOD'])) {
            'GET' => $this->getRoutes,
            'POST' => $this->postRoutes,
            default => throw new \Exception('Unknown request method'),
        };

        foreach ($targetRoutes as $route) {
            self::runHandlerIfRelevantUri($route);
        }

    }


    /**
     * @param Route $route
     * @return mixed|null
     */
    private static function runHandlerIfRelevantUri(Route $route)
    {

        // корневой uri рассматриваем отдельно
        if ($route->uriTemplate === '/' && $_SERVER['REQUEST_URI'] === '/'){
            $method = $route->actionControllerMethod;
            return $route->controller->$method();
        }


        $pattern = '/(^\/)|(\/$)/';
        $clearUriRequest = preg_replace($pattern, '', strtolower($_SERVER['REQUEST_URI']));
        $clearUriTemplate = preg_replace($pattern, '', $route->uriTemplate);

        // шаблон роута не содержит параметров и полностью совпадает с REQUEST_URI запроса
        if (
            ( !str_contains($clearUriTemplate, '{') || !str_contains($clearUriTemplate, '}') )
            &&
            $clearUriTemplate === $clearUriRequest
        ) {
            $method = $route->actionControllerMethod;
            return $route->controller->$method();
        }


        $uriTemplateArray = explode('/', $clearUriTemplate);
        $uriRequestArray = explode('/', $clearUriRequest);

//        $pattern = '/(^\{)(\}$)/';
//        foreach ($uriTemplateArray as $key => $templateItem){
//            if (preg_match($))
//        }

        return null;
    }

}