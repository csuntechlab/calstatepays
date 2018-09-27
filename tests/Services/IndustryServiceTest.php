<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Services\IndustryService;

class IndustryServiceTest extends TestCase
{
    use DatabaseMigrations;
    protected $industryService;

    public function setUp()
    {
        parent::setUp();
        $this->industryService= new IndustryService();
        $this->seed('Naics_Titles_TableSeeder');
    }

    public function test_getAllIndustryNaicsTitles_returns_all_rows()
    {
        // route is api/industry/naics-titles
        $response = $this->industryService->getAllIndustryNaicsTitles();
        $this->assertArrayHasKey("naics_code", $response[0]);    
        $this->assertArrayHasKey("title", $response[0]);        
        $this->assertArrayHasKey('image', $response[0]);
    }

     public function test_getIndustryPopulationByRank_returns_relevant_data_respective_to_hegist_code()
     {
         // route is api/industry/{hegis_code}/{university_id}
         // i.e. api/industry/5021/70
         $this->seed('University_Majors_TableSeeder');
         $this->seed('Master_Industry_Path_Types_Table_Seeder');
         $this->seed('Master_Industry_Wages_Table_Seeder');
         $this->seed('Population_Table_Seeder');
         $this->seed('Universities_TableSeeder');
         $response = $this->industryService->getIndustryPopulationByRank(22111, 70);
         $this->assertArrayHasKey("title", $response[0]);
         $this->assertArrayHasKey("percentage", $response[0]);
         $this->assertArrayHasKey('rank', $response[0]);
         $this->assertArrayHasKey('image', $response[0]);
     }
}