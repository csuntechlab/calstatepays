<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentBackground extends Model
{
    public $primary = 'id';
    public $timestamps = false;

    protected $fillable = [
        'university_major_id',
        'age_range_id',
        'education_level',
        'student_background_id'
    ];

    public function investment(){
        return $this->hasMany('App\Models\Investment','student_background_id','id');
    }

    public function age(){
        return $this->hasOne('App\Models\Age');
    }
}
