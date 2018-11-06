<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Services\IndustryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class IndustryServiceTest extends TestCase
{
    use DatabaseMigrations;
    protected $industryService;

    public function setUp()
    {
        parent::setUp();
        $this->industryService = new IndustryService();
    }

    // route is api/industry/naics-titles
    public function test_getAllIndustryNaicsTitles_returns_all_rows()
    {
        $this->seed('Naics_Titles_TableSeeder');

        $response = $this->industryService->getAllIndustryNaicsTitles();

        $this->assertArrayHasKey("naics_code", $response[0]);
        $this->assertArrayHasKey("title", $response[0]);
        $this->assertArrayHasKey('image', $response[0]);
    }

    public function test_getAllIndustryNaicsTitles_throws_a_model_not_found_exception()
    {
        $message = 'There is no Naics Title data';
        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException', $message, 409);
        $response = $this->industryService->getAllIndustryNaicsTitles();
    }

    // route is api/industry/{hegis_code}/{university_id}
    // i.e. api/industry/5021/northridge
    public function test_getIndustryPopulationByRankWithImages_returns_relevant_data_respective_to_hegis_code()
    {
        $this->seed('Naics_Titles_TableSeeder');
        $this->seed('Northridge_University_Majors_TableSeeder');
        $this->seed('Northridge_Industry_Path_Types_TableSeeder');
        $this->seed('Northridge_Industry_Path_Wages_TableSeeder');
        $this->seed('Northridge_Industry_Population_TableSeeder');
        $this->seed('Universities_TableSeeder');

        $response = $this->industryService->getIndustryPopulationByRankWithImages(5021, 'northridge', 1);

        $this->assertArrayHasKey("title", $response[0]);
        $this->assertArrayHasKey("percentage", $response[0]);
        $this->assertArrayHasKey('rank', $response[0]);
        $this->assertArrayHasKey('image', $response[0]);
    }

    // route is api/industry/{hegis_code}/{university_id}
    // i.e. api/industry/5021/northridge/1
    public function test_getIndustryPopulationByRank_returns_relevant_data_respective_to_hegis_code()
    {
        $this->seed('Universities_TableSeeder');
        $this->seed('Naics_Titles_TableSeeder');
        $this->seed('Northridge_University_Majors_TableSeeder');
        $this->seed('Northridge_Industry_Path_Types_TableSeeder');
        $this->seed('Northridge_Industry_Path_Wages_TableSeeder');
        $this->seed('Northridge_Industry_Population_TableSeeder');

        $university_name = 'northridge';
        $hegis = 5021;
        $degreeLevel = 1;

        $response = $this->industryService->getIndustryPopulationByRank($hegis, $university_name, $degreeLevel);

        $this->assertArrayHasKey("title", $response[0]);
        $this->assertArrayHasKey("percentage", $response[0]);
        $this->assertArrayHasKey('rank', $response[0]);
    }

    public function test_getIndustryPopulationByRankWithImages_throws_a_model_not_found_exception()
    {
        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException');
        $response = $this->industryService->getIndustryPopulationByRankWithImages(22111, 'northridge', 1);
    }

    public function test_getIndustryPopulationByRank_throws_a_model_not_found_exception()
    {
        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException');

        $response = $this->industryService->getIndustryPopulationByRank(22111, 'northridge', 1);
    }

    /**
     * industry/images/{hegis_code}/{university_name}
     * industry/images/5021/all
     * function IndustryController@getIndustryPopulationByRankWithImages
     * Use phpunit to get real api vals, test agaisnt real api output from route
     */
    public function test_Aggregate_getIndustryPopulationByRankWithImages()
    {

        $this->seed('Universities_TableSeeder');
        $this->seed('Aggregate_University_Majors_TableSeeder');
        $this->seed('Aggregate_Industry_Path_Types_TableSeeder');
        $this->seed('Aggregate_Industry_Path_Wages_TableSeeder');
        $this->seed('Aggregate_Industry_Population_TableSeeder');
        $this->seed('Naics_Titles_TableSeeder');

        $university_name = 'all';
        $hegis = 5021;
        $degreeLevel = 1;
        $response = $this->industryService->getIndustryPopulationByRankWithImages($hegis, $university_name, $degreeLevel);

        /**
         * real values from the actual array
         * this is position 0 from the real api
         * it is possible for the need to switch these values in the future
         * in order to make the test pass
         */
        $truthyArray = [
            [
                "title" => "No Wages",
                "percentage" => 50.86,
                "rank" => 1,
                "image" => "/img/industries/no_wages.png",
                "industryWage" => null
            ]
        ];

        $this->assertEquals($truthyArray[0]['title'], $response[0]['title']);
        $this->assertEquals($truthyArray[0]['percentage'], $response[0]['percentage']);
        $this->assertEquals($truthyArray[0]['rank'], $response[0]['rank']);
        $this->assertEquals(asset($truthyArray[0]['image']), $response[0]['image']);
        $this->assertEquals($truthyArray[0]['industryWage'], $response[0]['industryWage']);
    }

    /**
     *   api is industry/{hegis_code}/{universityName}
     *   api is api/industry/5021/all
     *   testing agaisnt real api vals
     *   (same as above)
     */

    public function test_Aggregate_getIndustryPopulationByRank()
    {
        $this->seed('Universities_TableSeeder');
        $this->seed('Aggregate_University_Majors_TableSeeder');
        $this->seed('Aggregate_Industry_Path_Types_TableSeeder');
        $this->seed('Aggregate_Industry_Path_Wages_TableSeeder');
        $this->seed('Aggregate_Industry_Population_TableSeeder');
        $this->seed('Naics_Titles_TableSeeder');

        $university_name = 'all';
        $hegis = 5021;
        $degreeLevel = 1;

        $response = $this->industryService->getIndustryPopulationByRank($hegis, $university_name, $degreeLevel);

        $truthyArray = [
            [
                "title" => "No Wages",
                "percentage" => 50.86,
                "rank" => 1,
                "industryWage" => null
            ]
        ];

        $this->assertEquals($truthyArray[0]['title'], $response[0]['title']);
        $this->assertEquals($truthyArray[0]['percentage'], $response[0]['percentage']);
        $this->assertEquals($truthyArray[0]['rank'], $response[0]['rank']);
        $this->assertEquals($truthyArray[0]['industryWage'], $response[0]['industryWage']);
    }

}