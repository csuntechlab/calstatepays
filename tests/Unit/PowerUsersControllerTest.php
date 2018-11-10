<?php

namespace Tests\Feature;

use App\Http\Controllers\PowerUsersController;
use App\Contracts\PowerUsersContract;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use App\Http\Requests\MajorFormRequest;
use Illuminate\Support\Facades\Validator;

class PowerUsersControllerTest extends TestCase
{
    use DatabaseMigrations;

    private $controller;
    private $retriever;

    public function setUp()
    {
        parent::setUp();
        $this->seed('Power_User_Data_Aggregate_TableSeeder');
        $this->seed('Power_User_Data_Northridge_TableSeeder');
        $this->seed('Power_User_Data_Channel_Islands_TableSeeder');
        $this->seed('Power_User_Data_Dominguez_Hills_TableSeeder');
        $this->seed('Power_User_Data_Fullerton_TableSeeder');
        $this->seed('Power_User_Data_Long_Beach_TableSeeder');
        $this->seed('Power_User_Data_Los_Angeles_TableSeeder');
        $this->seed('Power_User_Data_Pomona_TableSeeder');
        $this->seed('Universities_TableSeeder');

    }

    /** Test the only route */
    public function test_getPowerUserDataByUniversity()
    {
        $university = 'northridge';
        $path_id = 1;
        $response = $this->get('/api/power/' . $university . '/' . $path_id);
        $response = $response->getOriginalContent();

        $this->assertEquals($response['tabFrame'],"CSUNLaborMarketOutcomes-ByMajor&#47;Story1");
    }

}