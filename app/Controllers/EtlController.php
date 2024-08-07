<?php

namespace App\Controllers;

use App\Models\ExcelDataSource;
use App\Models\DataSourceInterface;

class EtlController extends AbstractController
{

    public function extractFromExcelForSeed()
    {

        // todo Вхардкодил для отладки. На бою использовать передачу имени файла в параметре запроса file_name
//        $dataSource = new ExcelDataSource(fileName: $this->params['file_name']);
        $dataSource = new ExcelDataSource(fileName: '/var/www/input_files/estate.xlsx');

        $result = $dataSource->readDraftData();

        echo '<pre>';
        print_r($result);
    }

}