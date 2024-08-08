<?php

namespace App\Models;

use App\Services\DbService;
use PDO;

class ManagerDbRepository extends AbstractDbRepository
{

    protected static string $dbTable = 'manager';
    protected static array $filterAttributes = ['agency_id' => PDO::PARAM_INT];

    /**
     * @return void
     */
   public static function loadNewFromEtlDraftInputData(): void
   {
        $sql = file_get_contents(__DIR__ . '/SQL/load_from_draft_to_manager.sql');
        DbService::getDB()->query($sql);
    }
}