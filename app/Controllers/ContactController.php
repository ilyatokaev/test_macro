<?php

namespace App\Controllers;

use App\Models\ContactDbRepository;
use App\Models\Contact as Model;
use SimpleXMLElement;

class ContactController extends AbstractController
{

    public function index()
    {
        echo json_encode(ContactDbRepository::all(), JSON_UNESCAPED_UNICODE);
    }


    public function filter()
    {
        echo json_encode(Model::filter($this->params), JSON_UNESCAPED_UNICODE);
    }
}