<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function majorPathWage() {
        return $this->hasOne('App\MajorPathWage');
    }
    public function industryPathType() {
        return $this->hasOne('App\IndustryPathType');
    }
}
