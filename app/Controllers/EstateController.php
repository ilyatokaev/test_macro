<?php

namespace App\Controllers;

use App\Models\EstateDbRepository;
use App\Services\Outputer;

class EstateController extends AbstractController
{

    /**
     * @return void
     */
    public function index()
    {
        Outputer::outputArray(EstateDbRepository::all());
    }


    /**
     * @return array|void
     */
    public function filter()
    {

        if (isset($this->params['agency_id'])){
            Outputer::outputArray(EstateDbRepository::findWithAgencyId($this->params['agency_id']));
            return;
        }

        Outputer::outputArray(EstateDbRepository::filter($this->params));
    }



}