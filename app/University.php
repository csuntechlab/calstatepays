<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function universityMajors() {
        return $this->hasMany('App\UniversityMajor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function duringSchoolDatas() {
        return $this->hasMany('App\DuringSchoolData');
    }
}
