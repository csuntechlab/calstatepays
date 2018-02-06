<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndustryPathType extends Model
{
    public $primaryKey = 'id';
    protected $fillable = [
        'entry_status',
        'naics_code',
        'student_path',
        'population_sample_id',
        'university_majors_id'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function studentPath() {
        return $this->hasOne('App\StudentPath','id','student_path');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function naicsTitle() {
        return $this->hasOne('App\NaicsTitle','naics_code','naics_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function universityMajor() {
        return $this->hasOne('App\UniversityMajor','id','university_majors_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function population() {
        return $this->hasOne('App\Population','id','population_sample_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function industryWage() {
        return $this->hasOne('App\IndustryWage','id','id');
    }
}
