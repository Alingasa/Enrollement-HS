<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectLoad extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function enrollment(){
        return $this->belongsTo(Enrollment::class);
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
