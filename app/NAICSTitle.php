<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NaicsTitle extends Model
{
    public $table = "naics_titles";
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
        return $this->hasMany('App\IndustryPathType','naics_code');
    }

    public function industryWage()
    {
        return $this->hasManyThrough('App\IndustryWage','App\IndustryPathType','naics_code','id');
    }
}
