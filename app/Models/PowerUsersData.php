<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PowerUsersData extends Model
{
    public $primaryKey = 'id';
    protected $table = "power_users_data";
    public $timestamps = false;


    protected $fillable = [
        'university_id',
        'path_id',
        'iFramePath'
    ];

}
