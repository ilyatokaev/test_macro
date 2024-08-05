<?php

namespace App;

use App\Route\Router;

class App
{

    public function run()
    {
        $router = Router::getInstance();
        $router->do();
//        echo '<pre>';
//        print_r($router);
    }


}