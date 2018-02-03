<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MajorPathWage extends Model
{
    protected $fillable = [
        'id',
        'avg_annual_wage',
        '25th',
        '50th',
        '75th',
        'population_sample_id'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function majorPath() {
    return $this->hasOne('App\MajorPath','id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function population() {
        return $this->hasOne('App\Population','id','population_sample_id');
    }
}
