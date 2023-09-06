<?php

use JamesGordo\JapanPostalCode\Http\Controllers\CityController;
use JamesGordo\JapanPostalCode\Http\Controllers\PostalCodeController;
use JamesGordo\JapanPostalCode\Http\Controllers\PrefectureController;

Route::middleware('api')
    ->prefix('api/jp')
    ->group(function () {
        Route::get('/cities', CityController::class)->name('cities.all');
        Route::get('/prefectures', PrefectureController::class)->name('prefectures.all');
        Route::get('/postal-codes/{code}', [PostalCodeController::class, 'retrieve'])->name('search.code');
    });
