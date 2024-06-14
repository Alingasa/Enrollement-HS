<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentformController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[StudentController::class,'welcome']);
Route::resource('/students', StudentController::class);
Route::post('/updatestudent',[StudentController::class,'updatestudent']);

Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

// Route::post('/student', [StudentformController::class, 'createstudent']);
