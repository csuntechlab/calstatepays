<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityMajor extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function university() {
        return $this->hasOne('App\University');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hegisCode() {
        return $this->hasOne('App\HEGISCode');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function college() {
        return $this->hasOne('App\College');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function majorPaths() {
        return $this->hasMany('App\MajorPath');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function industryPathTypes() {
        return $this->hasMany('App\IndustryPathType');
    }
}
