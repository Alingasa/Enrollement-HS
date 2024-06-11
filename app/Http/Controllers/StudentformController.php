<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentformController extends Controller
{
    //

    public function studentform(){
        return view('StudentForm');
    }

    public function cancelstudentform(){
        return view('welcome');
    }
}
