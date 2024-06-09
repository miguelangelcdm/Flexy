<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('mqtt',[ServiceController::class,'index']);
Route::post('data/save',[ServiceController::class,'save']);
