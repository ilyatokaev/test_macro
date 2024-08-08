<?php

namespace App\Controllers;

use App\Models\AgencyDbRepository;
use App\Services\Outputer;

class AgencyController extends AbstractController
{

    /**
     * @return void
     */
    public function index(): void
    {
        Outputer::outputArray(AgencyDbRepository::all());
    }

}