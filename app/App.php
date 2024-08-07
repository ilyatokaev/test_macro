<?php

namespace App;

use App\Route\Router;

class App
{

    private static ?array $env = null; // Массив-синглтон параметров окружения (из ini-файла)

    private const APP_INI_FILE = __DIR__ . '/../app.ini';

    public function run()
    {
        App::readAppIni();
        $router = Router::getInstance();
        $router->do();
    }


    /**
     * Читаем файл инициализации переменных окружения (приложения)
     */
    private static function readAppIni(): void
    {
        if (null === self::$env) {
            self::$env = parse_ini_file(self::APP_INI_FILE);
        }

    }


    /**
     * Возвращает значение параметра окружения по его (параметра) имени
     *
     * @param string $paramName
     * @return mixed|null
     */
    public static function getEnvParam(string $paramName): mixed
    {
        return self::$env[$paramName] ?? null;
    }
}