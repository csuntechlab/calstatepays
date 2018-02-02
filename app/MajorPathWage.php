<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MajorPathWage extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function majorPath() {
    return $this->hasOne('App\MajorPath');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function population() {
        return $this->hasOne('App\Population');
    }
}
