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
        'age_range_name',
        'education_level'
    ];

    public function investment(){
        return $this->hasMany('App\Models\Investment','student_background_id','id');
    }

}
