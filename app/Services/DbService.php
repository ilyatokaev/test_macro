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
//var_dump(App::getEnvParam('DB_PASSWORD'));
//die();
        if (null === self::$dbConnect){
echo date('Y-m-d H:i:s ') . '11111111111111111';
            self::$dbConnect = new PDO(
                'mysql:host=db;dbname=ads;charset=UTF8'
                , 'root'
                , 'adstmppwdforroot'
            );
//            self::$dbConnect = new PDO(
//                App::getEnvParam('DB_DSN')
//                , App::getEnvParam('DB_USER')
//                , App::getEnvParam('DB_PASSWORD')
//            );
        }

        return self::$dbConnect;
    }

}