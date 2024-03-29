<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    public $primaryKey = 'id';
    public $timestamps = false;    
    public $incrementing = true;

    protected $fillable = [
        'population_found',
        'population_size',
        'universityId',
        'naics',
        'percentage_found'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function majorPathWage() {
        return $this->hasOne('App\Models\MajorPathWage');
    }
    public function industryPathType() {
        return $this->hasOne('App\Models\IndustryPathType');
    }
}
