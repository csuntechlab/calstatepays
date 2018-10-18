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

    public function test_getAllIndustryNaicsTitles_returns_all_rows()
    {
        $this->seed('Naics_Titles_TableSeeder');
        // route is api/industry/naics-titles
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

    public function test_getIndustryPopulationByRankWithImages_returns_relevant_data_respective_to_hegis_code()
    {
        $this->seed('Naics_Titles_TableSeeder');
         // route is api/industry/{hegis_code}/{university_id}
         // i.e. api/industry/5021/northridge
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Master_Industry_Path_Types_Table_Seeder');
        $this->seed('Master_Industry_Wages_Table_Seeder');
        $this->seed('Population_Table_Seeder');
        $this->seed('Universities_TableSeeder');
        $response = $this->industryService->getIndustryPopulationByRankWithImages(5021, 'northridge');
        $this->assertArrayHasKey("title", $response[0]);
        $this->assertArrayHasKey("percentage", $response[0]);
        $this->assertArrayHasKey('rank', $response[0]);
        $this->assertArrayHasKey('image', $response[0]);
    }

    public function test_getIndustryPopulationByRank_returns_relevant_data_respective_to_hegis_code()
    {
        $this->seed('Naics_Titles_TableSeeder');
         // route is api/industry/{hegis_code}/{university_id}
         // i.e. api/industry/5021/northridge
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Master_Industry_Path_Types_Table_Seeder');
        $this->seed('Master_Industry_Wages_Table_Seeder');
        $this->seed('Population_Table_Seeder');
        $this->seed('Universities_TableSeeder');
        $response = $this->industryService->getIndustryPopulationByRank(5021, 'northridge');
        $this->assertArrayHasKey("title", $response[0]);
        $this->assertArrayHasKey("percentage", $response[0]);
        $this->assertArrayHasKey('rank', $response[0]);
    }

    public function test_getIndustryPopulationByRankWithImages_throws_a_model_not_found_exception()
    {
        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException');
        $response = $this->industryService->getIndustryPopulationByRankWithImages(22111, 'northridge');
    }

    public function test_getIndustryPopulationByRank_throws_a_model_not_found_exception()
    {
        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException');
        $response = $this->industryService->getIndustryPopulationByRank(22111, 'northridge');
    }

    /**
     * industry/images/{hegis_code}/{university_name}
     * industry/images/5021/all_cal_states
     * function IndustryController@getIndustryPopulationByRankWithImages
     * Use phpunit to get real api vals, test agaisnt real api output from route
     */
    public function test_Aggregate_getIndustryPopulationByRankWithImages()
    {
        $this->seed('Universities_TableSeeder');
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Master_Industry_Path_Types_Table_Seeder');
        $this->seed('Master_Industry_Wages_Table_Seeder');
        $this->seed('Population_Table_Seeder');
        $this->seed('Naics_Titles_TableSeeder');

        $university_name = 'all_cal_states';
        $hegis = 5021;
        $response = $this->industryService->getIndustryPopulationByRankWithImages($hegis, $university_name);

        /**
         * real values from the actual array
         * this is position 0 from the real api
         * it is possible for the need to switch these values in the future
         * in order to make the test pass
         */
        $truthyArray = [
            [
                "title" => "Professional, Scientific, & Technical Skills",
                "percentage" => 37.0,
                "rank" => 1,
                "image" => "/img/industries/professional_scientific_technical_skills.png",
                "industryWage" => '69328'
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
     *   testing agaisnt real api vals
     *   (same as above)
     */

    public function test_Aggregate_getIndustryPopulationByRank()
    {
        $this->seed('Universities_TableSeeder');
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Master_Industry_Path_Types_Table_Seeder');
        $this->seed('Master_Industry_Wages_Table_Seeder');
        $this->seed('Population_Table_Seeder');
        $this->seed('Naics_Titles_TableSeeder');

        $university_name = 'all_cal_states';
        $hegis = 5021;
        $response = $this->industryService->getIndustryPopulationByRank($hegis, $university_name);

        $truthyArray = [
            [
                "title" => "Professional, Scientific, & Technical Skills",
                "percentage" => 37.0,
                "rank" => 1,
                "industryWage" => "69328"
            ]
        ];

        $this->assertEquals($truthyArray[0]['title'], $response[0]['title']);
        $this->assertEquals($truthyArray[0]['percentage'], $response[0]['percentage']);
        $this->assertEquals($truthyArray[0]['rank'], $response[0]['rank']);
        $this->assertEquals($truthyArray[0]['industryWage'], $response[0]['industryWage']);
    }

}