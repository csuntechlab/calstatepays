<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndustryWage extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function industryPathType() {
        return $this->hasOne('App\IndustryPathType');
    }
}
