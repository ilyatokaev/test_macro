<?php

namespace App\Controllers;

use App\Models\EtlDraftInputData;
use App\Models\EtlSession;
use App\Models\EtlSessionDbRepository;
use App\Models\ExcelDataSource;
use App\Models\DataSourceInterface;

class EtlController extends AbstractController
{

    public function extractFromExcelForSeed()
    {

        if (isset($this->params['file_name'])) {
            $dataSource = new ExcelDataSource(fileName: $this->params['file_name']);
        } else {
            $dataSource = new ExcelDataSource(fileName: '/var/www/input_files/estate.xlsx');
        }

        $etlSession = new EtlSession('etl');
        EtlSessionDbRepository::save($etlSession);

        $draftData = $dataSource->readDraftData();

        echo '<pre>';
//        print_r($draftData);

        EtlDraftInputData::makeCollectionFromDraftData($draftData, $etlSession);
    }

}