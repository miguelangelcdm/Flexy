<?php

use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('mqtt',[ServiceController::class,'index']);
Route::post('data/save',[ServiceController::class,'save']);

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
        
    
    Route::resource('devices', DeviceController::class);

});
