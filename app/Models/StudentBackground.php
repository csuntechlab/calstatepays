<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentBackground extends Model
{
    public $primary = 'id';
    public $timestamps = false;

    protected $fillable = [
        'age_range_id',
        'age_range_name',
        'education_level',
        'investment_id',
        'university_major_id'
    ];

    public function investment(){
        return $this->hasMany('App\Models\Investment','id','investment_id');
    }
}
