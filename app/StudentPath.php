<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentPath extends Model
{
    public $primaryKey = 'id';

    protected $fillable = [
        'path_name'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function industryPathTypes() {
        return $this->hasMany('App\IndustryPathType','id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function majorPaths() {
        return $this->hasMany('App\MajorPath','id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function duringSchoolDatas() {
        return $this->hasMany('App\DuringSchoolData','student_path','id');
    }
}
