<?php

namespace App\Controllers;

use App\Models\ContactDbRepository;
use App\Models\Contact as Model;
use App\Services\Outputer;

class ContactController extends AbstractController
{

    /**
     * @return void
     */
    public function index()
    {
        Outputer::outputArray(ContactDbRepository::all());
    }


    /**
     * @return array|void
     */
    public function filter()
    {
        if (!isset($this->params['agency_id'])) {
            return [];
        }

        Outputer::outputArray(ContactDbRepository::findByAgencyId($this->params['agency_id']));
    }



}