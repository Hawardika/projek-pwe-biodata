<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonalDataController;

Route::get('/', function () {
    return redirect()->route('personal-data.index');
});

Route::resource('personal-data', PersonalDataController::class)
    ->parameters(['personal-data' => 'personalData'])
    ->only([
        'index',
        'create',
        'store',
        'edit',
        'update',
    ]);
