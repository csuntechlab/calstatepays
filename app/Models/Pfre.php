<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pfre extends Model
{
    protected $fillable = [
        'fin_aid_0',
        'fin_aid_3000',
        'fin_aid_10000',
    ];

    protected $hidden = [
        'guid',
        'entry_status',
        'major',
        'in_school_earning',
        'created_at',
        'updated_at'
    ];

}
