<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MajorPathWage extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey = 'major_path_id';

    protected $fillable = [
        'major_path_id',
        '_25th',
        '_50th',
        '_75th',
        'population_sample_id'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function majorPath() {
    return $this->hasOne('App\Models\MajorPath','id','major_path_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function population() {
        return $this->hasOne('App\Models\Population','id','population_sample_id');
    }
}
