<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityMajor extends Model
{
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'hegis_code',
        'university_id',
    ];

    public function studentBackground(){
        return $this->hasMany('App\Models\StudentBackground','university_major_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function university() {
        return $this->hasOne('App\Models\University','id','university_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hegisCode() {
        return $this->hasOne('App\Models\HEGISCode','hegis_code','hegis_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function majorPaths() {
        return $this->hasMany('App\Models\MajorPath','university_majors_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function industryPathTypes() {
        return $this->hasMany('App\Models\IndustryPathType','university_majors_id','id');
    }

    public function scopeAllMajorPathWages($query,$hegis_code,$university_id){
             $query->where('hegis_code', $hegis_code)
                         ->where('university_id', $university_id)
                         ->with('majorPaths.majorPathWage')
                         ->first()->majorPaths->toArray();
    }
}
