<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    public $primaryKey = 'id';

    protected $fillable = [
        'university_name'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function universityMajors() {
        return $this->hasMany('App\Models\UniversityMajor','university_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function duringSchoolDatas() {
        return $this->hasMany('App\Models\DuringSchoolData','university_id','id');
    }
}
