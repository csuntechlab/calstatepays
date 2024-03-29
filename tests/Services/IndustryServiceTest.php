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
    // Test the JSON structure of getALLIndustryNaicsTitles API
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
    // Test to see the getIndustryPopulationByRankWithImages JSON structure
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

        $response = $this->industryService->getIndustryPopulationByRankWithImages(5021, 'northridge');

        $this->assertArrayHasKey("title", $response['post_bacc'][0]);
        $this->assertArrayHasKey("percentage", $response['post_bacc'][0]);
        $this->assertArrayHasKey('rank', $response['post_bacc'][0]);
        $this->assertArrayHasKey('image', $response['post_bacc'][0]);
        $this->assertArrayHasKey('major_id', $response);
    }
    // Test to check the getIndustryByRank JSON structure
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

        $response = $this->industryService->getIndustryPopulationByRank($hegis, $university_name);

        $this->assertArrayHasKey("title", $response['someCollege'][0]);
        $this->assertArrayHasKey("percentage", $response['someCollege'][0]);
        $this->assertArrayHasKey('rank', $response['someCollege'][0]);
        $this->assertArrayHasKey('major_id', $response);
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
     * Test the populationByRankWithImages API
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
        $response = $this->industryService->getIndustryPopulationByRankWithImages($hegis, $university_name);

        /**
         * real values from the actual array
         * this is position 0 from the real api
         * it is possible for the need to switch these values in the future
         * in order to make the test pass
         */
        $bachelors = [
            [
                "title" => "Professional, Scientific, & Technical Skills",
                "percentage" => 37.28,
                "rank" => 1,
                "image" => asset("img/industries/professional_scientific_technical_skills.png"),
                "industryWage" => 71707
            ],
            "major_id" => 5021
        ];

        $this->assertEquals($bachelors[0]['title'], $response['bachelors'][0]['title']);
        $this->assertEquals($bachelors[0]['percentage'], $response['bachelors'][0]['percentage']);
        $this->assertEquals($bachelors[0]['rank'], $response['bachelors'][0]['rank']);
        $this->assertEquals(asset($bachelors[0]['image']), $response['bachelors'][0]['image']);
        $this->assertEquals($bachelors[0]['industryWage'], $response['bachelors'][0]['industryWage']);
        $this->assertEquals($bachelors["major_id"], $response["major_id"]);
    }

    /**
     *   Test the getIndustryPopulationByRank API
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

        $response = $this->industryService->getIndustryPopulationByRank($hegis, $university_name);

        //bachelors
        $truthyArray = [
            [
                "title" => "Professional, Scientific, & Technical Skills",
                "percentage" => 37.28,
                "rank" => 1,
                "industryWage" => "71707"
            ],
            "major_id" => 5021
        ];

        $this->assertEquals($truthyArray[0]['title'], $response['bachelors'][0]['title']);
        $this->assertEquals($truthyArray[0]['percentage'], $response['bachelors'][0]['percentage']);
        $this->assertEquals($truthyArray[0]['rank'], $response['bachelors'][0]['rank']);
        $this->assertEquals($truthyArray["major_id"], $response["major_id"]);
    }
}
