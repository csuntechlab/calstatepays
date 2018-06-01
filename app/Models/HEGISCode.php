<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HEGISCode extends Model
{
    public $primaryKey = 'hegis_code';
    protected $table = 'hegis_codes';
    public $timestamps = false;
    protected $fillable = [
        'hegis_code',
        'hegis_category_id',
        'major',
        'university',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function universityMajors() {
        return $this->hasMany('App\Models\UniversityMajor','hegis_code','hegis_code');
    }

    public function hegisCategory() {
        return $this->hasOne('App\Models\HEGISCategory', 'id', 'hegis_category_id');
    }
}
