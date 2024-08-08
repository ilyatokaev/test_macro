<?php

namespace App\Controllers;


use App\Models\ManagerDbRepository;
use App\Services\Outputer;


class ManagerController extends AbstractController
{

    /**
     * @return void
     */
    public function index()
    {
        Outputer::outputArray(ManagerDbRepository::all());
    }

    /**
     * @return void
     */
    public function filter()
    {
        Outputer::outputArray(ManagerDbRepository::filter($this->params));
    }
}