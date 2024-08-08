<?php

namespace App\Models;

use App\Services\DbService;
use PDO;

class EtlDraftInputDataDbRepository extends AbstractEtlDraftInputDataDbRepository
{

    protected static string $dbTable = 'etl_draft_input_data';


}