<?php

namespace App\Models;

use App\CivilStatus;
use App\GenderType;
use App\GradeType;
use App\Status;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // protected $with = ['user'];

    protected $appends = ['full_name', 'age'];

    protected function casts()
    {
        return [
            'grade_level' => GradeType::class,
            'civil_status' => CivilStatus::class,
            'gender'       => GenderType::class,
            'status'       => Status::class,
        ];
    }
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthdate)->age;
    }

    public function getFullNameAttribute()
    {
        $fullName = "{$this->last_name}, {$this->first_name}";
        if (!empty($this->middle_name)) {
            $fullName .= " {$this->middle_name[0]}.";
        }
        return $fullName;
    }

    public function strand(){
      return  $this->belongsTo(Strand::class);
    }
    // public function setSchoolIdAttribute(){
    //     $currentYear = Carbon::now()->year;
    //     $lastTwoDigits = substr($currentYear, -2);

    //     return $this->attributes['school_id'] = $lastTwoDigits.'-'.str_pad(Student::count(), 4, '0', STR_PAD_LEFT);
    // }
}
//24-0001
