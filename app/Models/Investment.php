<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    //
    public $primary = 'id';

    protected $fillable = [
        'student_background_id',
        'annual_earnings_id',
        'annual_earnings_name',
        'annual_financial_aid_id',
        'annual_financial_aid_name',
        'time_to_degree',
        'earnings_5_years',
        'roi'
    ];


}
