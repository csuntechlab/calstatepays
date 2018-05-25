<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnualEarning extends Model
{
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'annual_earnings_name'
    ];
}
