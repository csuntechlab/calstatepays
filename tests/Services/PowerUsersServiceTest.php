<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Services\PowerUsersService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PowerUsersServiceTest extends TestCase
{
    use DatabaseMigrations;
    protected $powerUserService;

    public function setUp()
    {
        parent::setUp();
        $this->powerUserService = new PowerUsersService();
        $this->seed('Universities_TableSeeder');
    }

    /**
     * * Test if aggregate and path 1 return the proper json
     */
    public function test_getPowerUserDataByUniversity_aggregate()
    {
        $this->seed('Power_User_Data_Aggregate_TableSeeder');
        $university = 'all';
        $path_id = 1;

        $response = $this->powerUserService->getPowerUserDataByUniversity($university, $path_id);
        $this->assertEquals($response['iframe_string'], "CSU7LaborMarketOutcomes-ByMajor&#47;CSU7AggregareEarningsData");
    }

    /**
     * Test if northridge and path 1 return the proper json
     */
    public function test_getPowerUserDataByUniversity_northridge()
    {
        $this->seed('Power_User_Data_Northridge_TableSeeder');
        $university = 'northridge';
        $path_id = 1;

        $response = $this->powerUserService->getPowerUserDataByUniversity($university, $path_id);
        $this->assertEquals($response['iframe_string'], "CSUNLaborMarketOutcomes-ByMajor&#47;Story1");
    }

    /**
     * Test if model not found exception is thrown
     */
    public function test_getPowerUserDataByUniversity_throws_a_model_not_found_exception()
    {
        $university = 'random_University';
        $path_id = 1;

        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException');

        $response = $this->powerUserService->getPowerUserDataByUniversity($university, $path_id);
    }
}
