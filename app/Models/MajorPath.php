<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MajorPath extends Model
{
    public $primaryKey = 'id';
    protected $fillable = [
        'student_path',
        'university_majors_id',
        'entry_status',
        'years'

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
    public function universityMajor() {
        return $this->hasOne('App\Models\UniversityMajor','id','university_major_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function majorPathWage() {
        return $this->hasOne('App\Models\MajorPathWage','major_path_id','id');
    }
}
