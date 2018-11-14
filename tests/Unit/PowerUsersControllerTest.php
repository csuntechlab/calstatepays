<?php

namespace Tests\Feature;

use App\Http\Controllers\PowerUsersController;
use App\Contracts\PowerUsersContract;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use Illuminate\Support\Facades\Validator;

class PowerUsersControllerTest extends TestCase
{
    use DatabaseMigrations;

    private $controller;
    private $retriever;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(PowerUsersContract::class);
        $this->controller = new PowerUsersController($this->retriever);
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

    /**
     * Api route : api/power/northridge/1
     * method : powerUsersController@getPowerUserDataByUniversity
     * test uses dependency injection 
     */
    public function test_getPowerUserDataByUniversity_northridge()
    {
        $university = 'northridge';
        $path_id = 1;

        $data = ["iframe_string" => "CSUNLaborMarketOutcomes-ByMajor&#47;Story1"];

        $this->retriever
            ->shouldReceive('getPowerUserDataByUniversity')
            ->with($university, $path_id)
            ->once()
            ->andReturn($data);

        $response = $this->controller->getPowerUserDataByUniversity($university, $path_id);
        $this->assertEquals($response, $data);
    }

    /**
     * Api route : api/power/all/1
     * method : powerUsersController@getPowerUserDataByUniversity
     * test uses dependency injection 
     */
    public function test_getPowerUserDataByUniversity_aggregate()
    {
        $university = 'aggregate';
        $path_id = 1;

        $data = ["iframe_string" => "CSU7LaborMarketOutcomes-ByMajor&#47;CSU7AggregareEarningsData"];

        $this->retriever
            ->shouldReceive('getPowerUserDataByUniversity')
            ->with($university, $path_id)
            ->once()
            ->andReturn($data);

        $response = $this->controller->getPowerUserDataByUniversity($university, $path_id);
        $this->assertEquals($response, $data);
    }

    /** Test the only route */
    public function test_getPowerUserDataByUniversity_by_route_northridge()
    {
        $university = 'northridge';
        $path_id = 1;
        $response = $this->get('/api/power/' . $university . '/' . $path_id);
        $response = $response->getOriginalContent();

        $this->assertEquals($response['iframe_string'], "CSUNLaborMarketOutcomes-ByMajor&#47;Story1");
    }

    /** Test the only route */
    public function test_getPowerUserDataByUniversity_by_route_aggregate()
    {
        $university = 'all';
        $path_id = 1;
        $response = $this->get('/api/power/' . $university . '/' . $path_id);
        $response = $response->getOriginalContent();

        $this->assertEquals($response['iframe_string'], "CSU7LaborMarketOutcomes-ByMajor&#47;CSU7AggregareEarningsData");
    }

    public function test_getPowerUserDataByUniversity_failed()
    {
        $university = 'random_University';
        $path_id = 1;
        $response = $this->get('/api/power/' . $university . '/' . $path_id);
        $response = $response->getOriginalContent();

        $responseFailed = [
            "collection" => "errors",
            "success" => false,
            "api" => "csuMetro",
            "version" => "1.0",
            "code" => 409,
            "message" => "Resource could not be resolved",
        ];

        $this->assertEquals($responseFailed, $response);
    }

}