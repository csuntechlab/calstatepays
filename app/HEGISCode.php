<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HEGISCode extends Model
{
    public $primaryKey = 'hegis_code';
    protected $fillable = [
        'hegis_code',
        'major'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function universityMajors() {
        return $this->hasMany('App\UniversityMajor','hegis_code','hegis_code');
    }
}
