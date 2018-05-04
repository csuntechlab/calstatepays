<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    public $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'population_found',
        'population_size',
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
