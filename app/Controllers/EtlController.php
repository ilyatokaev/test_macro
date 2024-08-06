<?php

namespace App\Controllers;

use App\Models\ExcelDataSource;
use App\Models\DataSourceInterface;

class EtlController extends AbstractController
{

    public function extractFromExcel()
    {
echo $this->params['file_name'];
die('ok');
        if (!isset($this->params['file_name'])) {
            throw new \Exception('undefined file_name param');
        }

        $dataSource = new ExcelDataSource(fileName: $this->params['file_name']);

        $result = $dataSource->readDraftData();
        print_r($result);
    }

}