<?php

namespace App;

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
        return $this->hasMany('App\UniversityMajor','university_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function duringSchoolDatas() {
        return $this->hasMany('App\DuringSchoolData','university_id','id');
    }
}
