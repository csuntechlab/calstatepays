<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentPath extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function industryPathTypes() {
        return $this->hasMany('App\IndustryPathType');
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
    public function duringSchoolDatas() {
        return $this->hasMany('App\DuringSchoolData');
    }
}
