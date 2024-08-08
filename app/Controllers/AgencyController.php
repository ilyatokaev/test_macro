<?php

namespace App\Controllers;

use App\Models\AgencyDbRepository;
use App\Services\Outputer;

class AgencyController extends AbstractController
{

    public function index()
    {
        Outputer::outputArray(AgencyDbRepository::all());
    }

}