<?php

namespace App\Models;

use App\Services\DbService;

class AgencyDbRepository extends AbstractDbRepository
{

    protected static string $dbTable = 'agency';

    /**
     * @return void
     */
    public static function loadNewFromEtlDraftInputData()
    {
        $sql = file_get_contents(__DIR__ . '/SQL/load_from_draft_to_agency.sql');
        DbService::getDB()->query($sql);
    }

}