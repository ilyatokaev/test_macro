<?php

namespace App\Models;

use App\Services\DbService;
use PDO;

class EstateDbRepository extends AbstractDbRepository
{

    protected static string $dbTable = 'estate';

    protected static array $filterAttributes = [
        'agency_id' => PDO::PARAM_INT,
        'contact_id' => PDO::PARAM_INT,
        'manager_id' => PDO::PARAM_INT,
    ];


    /**
     * Импорт данных из транзитной ETL-таблицы
     *
     * @return void
     */
    public static function loadNewFromEtlDraftInputData(): void
    {
        $sql = file_get_contents(__DIR__ . '/SQL/load_from_draft_to_estate.sql');
        DbService::getDB()->query($sql);
    }


    /**
     * @return array|false
     */
    public static function findWithAgencyId(int $agencyId): bool|array
    {

        $sql = 'select distinct e.* from ' . self::getDbTable() . ' e'
            . ' inner join manager m on m.id = e.manager_id and m.agency_id = :agency_id';

        $st = DbService::getDB()->prepare($sql);
        $st->bindParam(':agency_id', $agencyId, PDO::PARAM_INT);
        $st->execute();

        return $st->fetchAll(PDO::FETCH_ASSOC);

    }
}