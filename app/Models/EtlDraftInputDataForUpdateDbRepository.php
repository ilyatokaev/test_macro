<?php

namespace App\Models;

use App\Services\DbService;
use PDO;

class EtlDraftInputDataForUpdateDbRepository extends AbstractEtlDraftInputDataDbRepository
{

    protected static string $dbTable = 'etl_draft_input_data_for_update';


}