<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndustryWage extends Model
{
    protected $fillable = [
        'id',
        'avg_annual_wage_5',
        'avg_annual_wage_10'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function industryPathType() {
        return $this->hasOne('App\IndustryPathType','id','id');
    }
}
