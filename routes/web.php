<?php

use App\Http\Controllers\StudentformController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/studentform',[StudentformController::class,'studentform']);
Route::get('/cancelstudentform',[StudentformController::class, 'cancelstudentform']);
