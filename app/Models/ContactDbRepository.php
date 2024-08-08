<?php

namespace App\Models;

use App\Services\DbService;
use PDO;

class ContactDbRepository extends AbstractDbRepository
{

    protected static string $dbTable = 'contacts';
    protected static array $filterAttributes = ['id' => PDO::PARAM_INT];

    public static function saveNewInstance(ModelInterface $model): ModelInterface
    {
        // TODO: Implement saveNewInstance() method.
    }

    public static function updateInstance(ModelInterface $model): ModelInterface
    {
        // TODO: Implement updateInstance() method.
    }

    public static function loadNewFromEtlDraftInputData()
    {
        $sql = file_get_contents(__DIR__ . '/SQL/load_from_draft_to_contacts.sql');
        DbService::getDB()->query($sql);
    }
}