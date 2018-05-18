<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HEGISCode extends Model
{
    public $primaryKey = 'hegis_code';
    protected $table = 'hegis_codes';
    protected $fillable = [
        'hegis_code',
        'major',
        'university',
        'maturity_id'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function universityMajors() {
        return $this->hasMany('App\Models\UniversityMajor','hegis_code','hegis_code');
    }

    public function maturity(){
        return $this->hasMany('App\Models\Maturity','id','maturity_id');
    }
}
