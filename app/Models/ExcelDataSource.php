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
     * @return ?Spreadsheet
     */
    public function readDraftData(): ?Spreadsheet
    {
        return IOFactory::load($this->fileName);
    }
}