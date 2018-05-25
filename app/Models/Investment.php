<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    //
    public $primary = 'id';
    public $timestamps = false;

    protected $fillable = [
        'student_background_id',
        'annual_earnings_id',
        'annual_financial_aid_id',
        'time_to_degree',
        'earnings_5_years',
        'roi'
    ];

    public function annualEarning(){
        return $this->hasOne('App\Models\AnnualEarning', 'id', 'annual_earnings_name');
    }

    public function annualFinancialAid(){
        return $this->hasOne('App\Models\AnnualFinancialAid', 'id', 'annual_financial_aid_id');
    }
}
