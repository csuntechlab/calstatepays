<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HEGISCategory extends Model
{
    public $timestamps = false;
    protected $table = 'hegis_categories';
    protected $fillable = [
        'category_id',
        'category_name'
    ];
}
