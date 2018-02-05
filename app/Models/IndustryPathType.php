<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustryPathType extends Model
{
    public $primaryKey = 'id';
    protected $fillable = [
        'entry_stat',
        'naics_code',
        'student_path',
        'population_sample_id',
        'university_majors_id'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function studentPath() {
        return $this->hasOne('App\Models\StudentPath','id','student_path');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function naicsTitle() {
        return $this->hasOne('App\Models\NAICSTitle','naics_code','naics_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function universityMajor() {
        return $this->hasOne('App\Models\UniversityMajor','id','university_majors_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function population() {
        return $this->hasOne('App\Models\Population','id','population_sample_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function industryWage() {
        return $this->hasOne('App\Models\IndustryWage','id','id');
    }
}
