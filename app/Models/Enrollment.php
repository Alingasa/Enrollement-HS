<?php

namespace App\Models;

use App\Status;
use App\StudentTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    protected function casts()
    {
        return [
            'status'       => Status::class,
            'student_type' => StudentTypeEnum::class
        ];
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function student(){

        return $this->belongsTo(Student::class);
    }




}
