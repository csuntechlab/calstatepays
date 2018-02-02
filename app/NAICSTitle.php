<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NAICSTitle extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function industryPathTypes() {
        return $this->hasMany('App\IndustryPathType');
    }
}
