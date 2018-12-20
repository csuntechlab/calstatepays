<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PowerUserImage extends Model
{
    public $primaryKey = 'id';
    protected $table = "power_users_card_images";
    public $timestamps = false;


    protected $fillable = [
        'id',
        'university',
        'card_image',
        'opt_in'
    ];
}
