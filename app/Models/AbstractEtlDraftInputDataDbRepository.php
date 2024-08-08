<?php

namespace App\Models;

use App\Services\DbService;
use PDO;

class AbstractEtlDraftInputDataDbRepository extends AbstractDbRepository
{

    /**
     * @param ModelInterface|EtlSession $model
     * @return EtlSession|null
     */
    public static function saveNewInstance(ModelInterface|EtlSession $model): ?EtlSession
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

        return null;
    }

    /**
     * @param array $collection
     * @param EtlSession $etlSession
     * @return void
     */
    public static function seedFromCollection(array $collection, EtlSession $etlSession)
    {

        foreach ($collection as $row) {

            $sql = 'insert into ' .  self::getDbTable() . ' ';
            $setString = null;


            foreach ($row as $key => $value) {

                if (!isset($setString)) {
                    $setString = 'set ';
                } else {
                    $setString .= ', ';
                }

                $setString .= "{$key} = :{$key}";
            }


            $sql .= $setString . ", extract_session_id = {$etlSession->getId()};";
            $st = DbService::getDB()->prepare($sql);

            foreach ($row as $key => $value) {

                if ($key === 'estate_price') {
                    $newValue = (int) preg_replace("/[^0-9]/", '', $value);
                    $st->bindValue(":{$key}", $newValue, PDO::PARAM_INT);
                } else {
                    $st->bindValue(":{$key}", $value);
                }

            }

            $st->execute();

        }

        echo date('Y-m-d H:i:s ') . 'dddddd';
    }
}