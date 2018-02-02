<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DuringSchoolData extends Model
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
    public function studentPath() {
        return $this->hasOne('App\StudentPath');
    }
}
