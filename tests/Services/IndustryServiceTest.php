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
        $this->industryService= new IndustryService();
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
        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException',$message,409);
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
}