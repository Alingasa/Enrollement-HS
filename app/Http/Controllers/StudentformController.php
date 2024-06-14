<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentformController extends Controller
{
    //

    public function studentform(){
        return view('StudentForm');
    }

    public function cancelstudentform(){
        return view('welcome');
    }


    public function createstudent(Request $request)
    {
        try {

           $data =  $validateUser = Validator::make($request->all(),
            [

                'first_name' => 'required',
                'middle_name'=> 'required',
                'last_name'=> 'required',
                'email' => 'required|email|unique:users,email',
                'contact_number'=> 'required',
                'gender'=> 'required',
                'birthdate'=> 'required',
                'civil_status'=> 'required',
                'religion'=> 'required',
                'purok'=> 'required',
                'sitio_street'=> 'required',
                'barangay'=> 'required',
                'municipality'=> 'required',
                'province'=> 'required',
                'zip_code'=> 'required',
                'guardian_name'=> 'required',
                'grade_level'=> 'required',
                'strand'=> 'required',
                'profile_image' => 'required',

            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if ($request->hasFile('profile_image')) {
                $profilePath = $request->file('profile_image')->store('profile_image', 'public');
            } else {
                $profilePath = null;
            }

            $student = Student::create(['profile_image' => $profilePath ]);

            $student = Student::create([$data]);


            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $student->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }




    public function getschoolid(Request $request){
        $student = Student::find($request->school_id);
        return response()->json($student);
    }
}
