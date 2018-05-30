<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldOfStudy extends Model
{
    public $timestamps = false;
    public $table = 'field_of_studies';

    protected $fillable = [
        'id',
        'name',
        'hegis_category_id',
        'hegis_category_name'
    ];
}
