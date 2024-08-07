<?php

namespace App\Services;

use App\App;
use PDO;

class DbService
{

    private static ?PDO $dbConnect = null; // Подключение к БД. Синглтон

    /**
     * PDO-соединение реализовано, как синглтон
     * @return PDO|null
     */
    public static function getDB(): ?PDO
    {

        if (null === self::$dbConnect){
            self::$dbConnect = new PDO(
                App::getEnvParam('DB_DSN')
                , App::getEnvParam('DB_USER')
                , App::getEnvParam('DB_PASSWORD')
            );
        }

        return self::$dbConnect;
    }

}