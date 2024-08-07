<?php

namespace App\Models;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelDataSource  extends AbstractDataSource
{

    public function __construct(public readonly string $fileName)
    {
    }


    /**
     * @return ?array
     */
    public function readDraftData()
    {

        $reader = IOFactory::createReader('Xlsx');
        $data = $reader->setReadDataOnly(true)->load($this->fileName);

        return $data->getSheet($data->getFirstSheetIndex())->toArray();

    }
}