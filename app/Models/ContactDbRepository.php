<?php

namespace App\Models;

use App\Services\DbService;
use PDO;

class ContactDbRepository extends AbstractDbRepository
{

    protected static string $dbTable = 'contacts';


    /**
     * @return void
     */
    public static function loadNewFromEtlDraftInputData()
    {
        $sql = file_get_contents(__DIR__ . '/SQL/load_from_draft_to_contacts.sql');
        DbService::getDB()->query($sql);
    }

    /**
     * @param int $agencyId
     * @return array|false
     */
    public static function findByAgencyId(int $agencyId)
    {
        $sql = 'select distinct c.* from ' . self::getDbTable() . ' c'
            . ' inner join estate e on e.contact_id = c.id '
            . ' inner join manager m on m.id = e.manager_id and m.agency_id = :agency_id';

        $st = DbService::getDB()->prepare($sql);
        $st->bindParam(':agency_id', $agencyId, PDO::PARAM_INT);
        $st->execute();

        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}