<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NaicsTitle extends Model
{
    public $primaryKey = 'naics_code';
    public $timestamps = false;    
    public $incrementing = false;

    protected $fillable = [
        'naics_code',
        'naics_title',
        'image'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function industryPathTypes() {
        return $this->hasMany('App\Models\IndustryPathType', 'naics_code','naics_code');
    }
    public function industryWage()
    {
        return $this->hasManyThrough('App\Models\IndustryWage','App\Models\IndustryPathType','naics_code','id');
    }
}
