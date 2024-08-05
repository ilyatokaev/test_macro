<?php

App\Route\Route::get('/', \App\Controllers\Controller::class, 'index');
App\Route\Route::get('show', \App\Controllers\Controller::class, 'show');
App\Route\Route::get('show/{param}', \App\Controllers\Controller::class, 'show');
