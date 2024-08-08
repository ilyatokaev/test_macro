<?php

namespace App\Services;

class Outputer
{

    /**
     * @param array $array
     * @return void
     */
    public static function outputArray(array $array): void
    {

        echo json_encode($array, JSON_UNESCAPED_UNICODE);

    }

}