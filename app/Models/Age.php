<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'age_range_name'
    ];
}
