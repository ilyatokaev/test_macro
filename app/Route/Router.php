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


        // Перебираем все зарегистрированные в роутере роуты и если находим роут, соответствующий uri запроса, передаем работу контроллеру
        foreach ($targetRoutes as $route) {
            try {
                return self::runHandlerIfRelevantUri($route);
            } catch (\Exception $exception) {

                // uri не подошел, переходим к следующему
                if ($exception->getCode() === 601) {
                    continue;
                } else {
                    throw $exception;
                }
            }
        }

    }


    /**
     * @param Route $route
     * @return mixed|null
     * @throws \Exception
     */
    private static function runHandlerIfRelevantUri(Route $route)
    {

        $controllerMethod = $route->actionControllerMethod;

        // корневой uri рассматриваем отдельно, обособлено
        if ($route->uriTemplate === '/' && $_SERVER['REQUEST_URI'] === '/'){
            return $route->controller->$controllerMethod();
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
            return $route->controller->$controllerMethod();
        }

        $uriTemplateArray = explode('/', $clearUriTemplate);
        $uriRequestArray = explode('/', $clearUriRequest);

        $uriParams = []; // массив параметров, включенных в uri
        $pattern = '/(^\{)(.*)(\}$)/';

        foreach ($uriTemplateArray as $key => $templateItem){

            // В uri запроса нет соответствующего компонента. Значит роут не подошел
            if (!isset($uriRequestArray[$key])){
                throw new \Exception("Роут не подошел", 601);
            }

            if (preg_match($pattern, $templateItem) === 1) {
                $clearParamName = preg_replace('/(^\{)|(\}$)/', '', $templateItem); // Очищаем имя параметра от фигурных скобок
                $uriParams[$clearParamName] = $uriRequestArray[$key]; // формируем массив параметров, включенных uri
                continue;
            }

            if ($templateItem !== $uriRequestArray[$key]) {
                throw new \Exception("Роут не подошел", 601);
            }

        }

        // Роут в запросе длиннее, чем шаблоне роутера. Значит, не подошел
        if (isset($uriRequestArray[$key + 1])) {
            throw new \Exception("Роут не подошел", 601);
        }


        return $route->controller->$controllerMethod($uriParams);

    }

}