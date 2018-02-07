<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityMajor extends Model
{
    public $primaryKey = 'id';

    protected $fillable = [
        'hegis_code',
        'college_id',
        'university_id'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function university() {
        return $this->hasOne('App\Models\University','id','university_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hegisCode() {
        return $this->hasOne('App\Models\HEGISCode','hegis_code','hegis_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function college() {
        return $this->hasOne('App\Models\College','id','college_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function majorPaths() {
        return $this->hasMany('App\Models\MajorPath','university_majors_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function industryPathTypes() {
        return $this->hasMany('App\Models\IndustryPathType','university_majors_id','id');
    }
}
