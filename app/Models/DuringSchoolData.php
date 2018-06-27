<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuringSchoolData extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'university_id',
        'student_path',
        'entry_stat',
        'potential_num_students',
        'num_students_non_year',
        'median_earnings_non_year',
        'num_students_enrolled',
        'num_students_full_year',
        'median_earnings_full_year',
        'year'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function university() {
        return $this->hasOne('App\Models\University','id','university_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function studentPath() {
        return $this->hasOne('App\Models\StudentPath','id','student_path'  );
    }
}
