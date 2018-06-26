<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPath extends Model
{
    public $primaryKey = 'id';
    public $timestamps = false;    

    protected $fillable = [
        'path_name'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function industryPathTypes() {
        return $this->hasMany('App\Models\IndustryPathType','id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function majorPaths() {
        return $this->hasMany('App\Models\MajorPath','id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function duringSchoolDatas() {
        return $this->hasMany('App\Models\DuringSchoolData','student_path','id');
    }
}
