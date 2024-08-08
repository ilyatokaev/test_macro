<?php
echo '<pre>';


App\Route\Route::get('/etl/extract/excel/seed', \App\Controllers\EtlController::class, 'extractFromExcelForSeed');

App\Route\Route::get('/agencies', \App\Controllers\AgencyController::class, 'index');
