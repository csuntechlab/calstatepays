<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NaicsTitle extends Model
{
    public $primaryKey = 'naics_code';
    public $incrementing = false;

    protected $fillable = [
        'naics_code',
        'naics_title'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function industryPathTypes() {
        return $this->hasMany('App\Models\IndustryPathType');
    }
    public function industryWage()
    {
        return $this->hasManyThrough('App\Models\IndustryWage','App\Models\IndustryPathType','naics_code','id');
    }
}
