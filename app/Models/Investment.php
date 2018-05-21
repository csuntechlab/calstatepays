<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    //
    public $primary = 'id';

    protected $fillable = [
        'annual_earnings_id',
        'annual_financial_aid_id',
        'time_to_degree',
        'earnings_5_years',
        'roi'
    ];



}
