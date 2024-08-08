<?php

namespace App\Models;

use App\Services\DbService;
use PDO;

class EtlSessionDbRepository extends AbstractDbRepository
{

    protected static string $dbTable = 'etl_sessions';


    /**
     * @param ModelInterface|EtlSession $model
     * @return EtlSession
     */
    public static function saveNewInstance(ModelInterface|EtlSession $model): EtlSession
    {

        $sql = 'insert into ' . self::getDbTable() . ' set type_code = :type_code';
        $pdo = DbService::getDB();
        $st = $pdo->prepare($sql);
        $typeCode = $model->typeCode; // пришлось ввести транзитную переменную, т.к. PDO отказалась работать с readonly-свойством
        $st->bindParam(':type_code', $typeCode, PDO::PARAM_STR);

        if ($st->execute()) {
            $model->setId($pdo->lastInsertId());
            return $model;
        }

    }


}