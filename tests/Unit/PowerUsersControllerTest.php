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

    public function test_getTableauOptInUniversityData()
    {

        $dataArray = ["0" => [["university_id" => 0, "path_id" => 1, "iframe_string" => "CSU7byMajor/CSU7AggregareEarningsData", "opt_in" => 1], ["university_id" => 0, "path_id" => 2, "iframe_string" => "CSU7byAge/CSU7byAge", "opt_in" => 1], ["university_id" => 0, "path_id" => 3, "iframe_string" => "CSU7byRace/CSU7byRace", "opt_in" => 1], ["university_id" => 0, "path_id" => 4, "iframe_string" => "CSU7byGender/CSU7byGender", "opt_in" => 1], ["university_id" => 0, "path_id" => 5, "iframe_string" => "CSU7byPell/CSU7byPell", "opt_in" => 1]], "70" => [["university_id" => 70, "path_id" => 1, "iframe_string" => "CSUNLaborMarketOutcomes-ByMajor/CSUNbyMajor", "opt_in" => 1], ["university_id" => 70, "path_id" => 2, "iframe_string" => "CSUNorthridge-ByAge26NOV2018/Northridge", "opt_in" => 1], ["university_id" => 70, "path_id" => 3, "iframe_string" => "CSUNorthridge-ByRace20NOV2018/CSUNByRace", "opt_in" => 1], ["university_id" => 70, "path_id" => 4, "iframe_string" => "CSUNorthridge-ByGender20NOV2018/CSUNbyGender", "opt_in" => 1], ["university_id" => 70, "path_id" => 5, "iframe_string" => "CSUNorthridge-ByPellGrant26NOV2018/Northridge", "opt_in" => 1]]];
        $data = json_encode($dataArray);

        $this->retriever
            ->shouldReceive('getTableauOptInUniversityData')
            ->once()
            ->andReturn($data);

        $response = $this->controller->getTableauOptInUniversityData();
        $this->assertEquals($response, $data);
    }

    /**
     * test the api 
     * api/power/images
     */
    public function test_getPowerUserImage()
    {
        $this->seed('Power_User_Card_Images_TableSeeder');
        $test = json_encode([["id" => 0, "card_image" => "http://localhost/img/csucampuses/allcsu.png", "university" => "Aggregate data Across the 7 CSUS", "opt_in" => "1"], ["id" => 70, "card_image" => "http://localhost/img/csucampuses/northridge.png", "university" => "California State University Northridge", "opt_in" => "1"], ["id" => 40, "card_image" => "http://localhost/img/csucampuses/longBeach.png", "university" => "California State University Long Beach", "opt_in" => "0"], ["id" => 45, "card_image" => "http://localhost/img/csucampuses/losAngeles.png", "university" => "California State University Los Angeles", "opt_in" => "0"], ["id" => 50, "card_image" => "http://localhost/img/csucampuses/fullerton.png", "university" => "California State University Fullerton", "opt_in" => "0"], ["id" => 55, "card_image" => "http://localhost/img/csucampuses/dominguezHills.png", "university" => "California State University Dominguez Hills", "opt_in" => "0"], ["id" => 73, "card_image" => "http://localhost/img/csucampuses/channelIslands.png", "university" => "California State University Channel Island", "opt_in" => "0"], ["id" => 10, "card_image" => "http://localhost/img/csucampuses/pomona.png", "university" => "California State University Pomona", "opt_in" => "0"]]);
        $response = $this->get('/api/power/images');
        $response = $response->getOriginalContent();
        $response = json_encode($response);
        $this->assertEquals($response, $test);
    }
}