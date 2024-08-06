<?php

namespace App\Services;



use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelService
{

    /**
     * @param string $fileName
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    public static function readFile(string $fileName)
    {
        return IOFactory::load($fileName);
    }

}