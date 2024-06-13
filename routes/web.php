<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentformController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[StudentController::class,'welcome']);
Route::resource('/students', StudentController::class);
Route::post('/updatestudent',[StudentController::class,'updatestudent']);


// Route::post('/student', [StudentformController::class, 'createstudent']);
