<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndustryPathType extends Model
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
    public function naicsTitle() {
        return $this->hasOne('App\NAICSTitle');
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
    public function population() {
        return $this->hasOne('App\Population');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function industryWage() {
        return $this->hasOne('App\IndustryWage');
    }
}
