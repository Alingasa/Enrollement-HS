<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Strand extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function students(){
       return $this->hasMany(Student::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }

    public function setNameAttribute($value){
        return $this->attributes['name'] = ucwords($value);
    }
}
