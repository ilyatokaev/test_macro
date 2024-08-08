<?php

namespace App\Controllers;

use App\Services\DbService;

class DdlController extends AbstractController
{

    public function initDb()
    {
        $sql = file_get_contents(__DIR__ . '/../../DDL/dump_start.sql');
        DbService::getDB()->query($sql);

        echo date('Y-m-d H:i:s ') . 'init DB done';
    }

}