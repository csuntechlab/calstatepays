<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'college_name'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function universityMajors() {
        return $this->hasMany('App\UniversityMajor','id','id' );
    }
}
