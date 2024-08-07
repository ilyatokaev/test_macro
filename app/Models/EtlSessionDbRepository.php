<?php

namespace App\Models;

use App\Services\DbService;
use PDO;

class EtlSessionDbRepository extends AbstractDbRepository
{

    protected static string $dbTable = 'etl_sessions';


    protected static function defineStoredProperties(EtlSession $etlSession)
    {
        // TODO: Implement defineStoredProperties() method.
    }


    public static function all(): ?array
    {
        // TODO: Implement all() method.
    }

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



    public static function updateInstance(ModelInterface $model): EtlSession
    {
        // TODO: Implement updateInstance() method.
    }

}