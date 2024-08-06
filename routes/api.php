<?php
echo '<pre>';

///var/www/input_files/estate.xlsx
App\Route\Route::get('/etl/extract/excel', \App\Controllers\EtlController::class, 'extractFromExcel');

App\Route\Route::get('/', \App\Controllers\Controller::class, 'index');
App\Route\Route::get('show', \App\Controllers\Controller::class, 'show');
App\Route\Route::get('show/{param}', \App\Controllers\Controller::class, 'showSingle');
App\Route\Route::get('show/{param}/{param2}', \App\Controllers\Controller::class, 'showDouble');
App\Route\Route::post('show', \App\Controllers\Controller::class, 'showPost');
