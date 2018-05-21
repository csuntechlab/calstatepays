<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentBackground extends Model
{
    public $primary = 'id';

    protected $fillable = [
        'age_range',
        'education_level',
        'investment_id'
    ];

    public function investment(){
        return $this->hasMany('App\Models\Investment','id','investment_id');
    }
}
