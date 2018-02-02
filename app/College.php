<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function universityMajors() {
        return $this->hasMany('App\UniversityMajor');
    }
}
