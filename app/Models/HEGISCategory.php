<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HEGISCategory extends Model
{
    public $timestamps = false;
    protected $table = 'hegis_categories';

    protected $fillable = [
        'id',
        'name',
        'field_of_study_id',
    ];
    public function hegisCode(){
        return $this->hasMany('App\Models\HEGISCode', 'hegis_category_id', 'id');
    }
}
