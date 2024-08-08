<?php
//echo '<pre>';

//print_r($_SERVER);
App\Route\Route::get('/etl/extract/excel/seed', \App\Controllers\EtlController::class, 'extractFromExcelForSeed');

App\Route\Route::get('/agencies', \App\Controllers\AgencyController::class, 'index');
App\Route\Route::get('/contacts', \App\Controllers\ContactController::class, 'index');
App\Route\Route::get('/contacts/filter', \App\Controllers\ContactController::class, 'filter');
