<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HEGISCategory extends Model
{
    public $timestamps = false;
    public $table = 'field_of_studies';

    protected $fillable = [
        'category_id',
        'category_name'
    ];
}
