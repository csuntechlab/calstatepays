<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnualFinancialAid extends Model
{
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $incrementing = [
        'name',
    ];
}
