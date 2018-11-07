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

    public function helloWorld()
    {
        return $this->powerUsersRetrieval->helloWorld();
    }
}
