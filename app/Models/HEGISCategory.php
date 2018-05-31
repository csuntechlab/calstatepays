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

    public function hegisCategory(){
        return $this->hasOne('App\Models\HEGISCategory', 'id', 'field_of_study_id');
    }
}
