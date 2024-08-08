<?php
//echo '<pre>';

//print_r($_SERVER);
App\Route\Route::get('/etl/extract/excel/seed', \App\Controllers\EtlController::class, 'extractFromExcelForSeed');
App\Route\Route::get('/etl/extract/excel/update', \App\Controllers\EtlController::class, 'extractFromExcelForUpdate');

App\Route\Route::get('/agencies', \App\Controllers\AgencyController::class, 'index');
App\Route\Route::get('/contacts', \App\Controllers\ContactController::class, 'index');
App\Route\Route::get('/contacts/filter', \App\Controllers\ContactController::class, 'filter');
App\Route\Route::get('/managers', \App\Controllers\ManagerController::class, 'index');
App\Route\Route::get('/managers/filter', \App\Controllers\ManagerController::class, 'filter');
App\Route\Route::get('/estate', \App\Controllers\EstateController::class, 'index');
App\Route\Route::get('/estate/filter', \App\Controllers\EstateController::class, 'filter');