<?php

namespace App\Controllers;

use App\Models\AgencyDbRepository;

class AgencyController extends AbstractController
{

    public function index()
    {
        echo json_encode(AgencyDbRepository::all(), JSON_UNESCAPED_UNICODE);
    }

}