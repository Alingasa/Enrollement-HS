<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function strand(){
      return $this->belongsTo(Strand::class);
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function teachers(){
        return $this->belongsToMany(related: Teacher::class , table: 'subject_teacher');
    }

    public function setSubjectTitleAttribute($value){
        return $this->attributes['subject_title'] = ucwords($value);
    }
}
