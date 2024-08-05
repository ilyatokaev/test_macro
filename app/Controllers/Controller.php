<?php

namespace App\Controllers;

class Controller extends AbstractController
{

    public function index()
    {
        echo date('Y-m-d H:i:s ') . 'Готово в контроллере index';
    }

    public function show()
    {
        echo date('Y-m-d H:i:s ') . 'Готово в контроллере show';
        print_r($this->params);
    }

    public function showSingle(array $params)
    {
        echo date('Y-m-d H:i:s ') . 'Готово в контроллере showSingle';
        print_r($params);
    }

    public function showDouble(array $params)
    {
        echo date('Y-m-d H:i:s ') . 'Готово в контроллере showSingle';
        print_r($params);
    }

    public function showPost()
    {
        echo date('Y-m-d H:i:s ') . 'Готово в контроллере showPost';

    }

}