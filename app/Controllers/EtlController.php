<?php

namespace App\Controllers;

use App\Models\AgencyDbRepository;
use App\Models\ContactDbRepository;
use App\Models\EstateDbRepository;
use App\Models\EtlDraftInputData;
use App\Models\EtlDraftInputDataDbRepository;
use App\Models\EtlSession;
use App\Models\EtlSessionDbRepository;
use App\Models\ExcelDataSource;
use App\Models\DataSourceInterface;
use App\Models\ManagerDbRepository;

class EtlController extends AbstractController
{

    public function extractFromExcelForSeed()
    {

        if (isset($this->params['file_name'])) {
            $dataSource = new ExcelDataSource(fileName: $this->params['file_name']);
        } else {
            $dataSource = new ExcelDataSource(fileName: '/var/www/input_files/estate.xlsx');
        }

        // Загрузка из источника в транзитную таблицу
        $etlSession = new EtlSession('etl');
        EtlSessionDbRepository::save($etlSession);
        $draftData = $dataSource->readDraftData();
        $forInsertArray = EtlDraftInputData::makeCollectionFromDraftData($draftData);

        EtlDraftInputDataDbRepository::seedFromCollection($forInsertArray, $etlSession);
        echo date('Y-m-d H:i:s ') . 'done';

        AgencyDbRepository::loadNewFromEtlDraftInputData();
        ContactDbRepository::loadNewFromEtlDraftInputData();
        ManagerDbRepository::loadNewFromEtlDraftInputData();
        EstateDbRepository::loadNewFromEtlDraftInputData();
    }

}