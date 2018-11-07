<?php

namespace App\Services;

use App\Contracts\PowerUsersContract;

class PowerUsersService implements PowerUsersContract
{
    public function helloWorld()
    {
        return "helloworld";
    }
}