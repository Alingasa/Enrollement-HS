<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // public function setNameAttribute($value)
    // {
    //     return $this->attributes['name'] = ucfirst($value);
    // }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }


    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucwords($value);
    }
}
