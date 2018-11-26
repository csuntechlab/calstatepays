<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\PowerUsersContract;

class PowerUsersController extends Controller
{
    protected $powerUsersRetrieval;

    public function __construct(PowerUsersContract $powerUsersContract)
    {
        $this->powerUsersRetrieval = $powerUsersContract;
    }

    public function getPowerUserDataByUniversity($university, $path_id)
    {
        return $this->powerUsersRetrieval->getPowerUserDataByUniversity($university, $path_id);
    }
}
