<?php

namespace App\Controllers;

use App\Models\AgencyDbRepository;
use App\Models\ContactDbRepository;
use App\Models\EstateDbRepository;
use App\Models\EtlDraftInputDataForSeed;
use App\Models\EtlDraftInputDataDbRepository;
use App\Models\EtlDraftInputDataForUpdate;
use App\Models\EtlDraftInputDataForUpdateDbRepository;
use App\Models\EtlSession;
use App\Models\EtlSessionDbRepository;
use App\Models\ExcelDataSource;
use App\Models\ManagerDbRepository;

class EtlController extends AbstractController
{

    /**
     * @return void
     */
    public function extractFromExcelForSeed(): void
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
        $forInsertArray = EtlDraftInputDataForSeed::makeCollectionFromDraftData($draftData);

        EtlDraftInputDataDbRepository::seedFromCollection($forInsertArray, $etlSession);

        AgencyDbRepository::loadNewFromEtlDraftInputData();
        ContactDbRepository::loadNewFromEtlDraftInputData();
        ManagerDbRepository::loadNewFromEtlDraftInputData();
        EstateDbRepository::loadNewFromEtlDraftInputData();

        echo date('Y-m-d H:i:s ') . 'done seeder';
    }


    public function extractFromExcelForUpdate(): void
    {
        if (isset($this->params['update_file_name'])) {
            $dataSource = new ExcelDataSource(fileName: $this->params['update_file_name']);
        } else {
            $dataSource = new ExcelDataSource(fileName: '/var/www/input_files/estate_update.xlsx');
        }

        $etlSession = new EtlSession('etl');
        EtlSessionDbRepository::save($etlSession);
        $draftData = $dataSource->readDraftData();
        $forUpdateArray = EtlDraftInputDataForUpdate::makeCollectionFromDraftData($draftData);
        EtlDraftInputDataForUpdateDbRepository::seedFromCollection($forUpdateArray, $etlSession);

        echo date('Y-m-d H:i:s ') . 'done updater';
    }
}