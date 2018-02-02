<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MajorPath extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function studentPath() {
        return $this->hasOne('App\StudentPath');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function universityMajor() {
        return $this->hasOne('App\UniversityMajor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function majorPathWage() {
        return $this->hasOne('App\MajorPathWage');
    }
}
