<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NAICSTitle extends Model
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
        return $this->hasMany('App\IndustryPathType');
    }
}
