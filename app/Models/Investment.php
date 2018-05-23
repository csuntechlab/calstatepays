<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    //
    public $primary = 'id';

    protected $fillable = [
        'annual_earnings',
        'annual_financial_aid',
        'time_to_degree',
        'earnings_5_years',
        'roi'
    ];



}
