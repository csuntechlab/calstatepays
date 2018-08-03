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
    }

    public function test_getAllIndustryNaicsTitles_returns_all_rows()
    {
        $this->seed('Naics_Titles_TableSeeder');
        $response = $this->industryService->getAllIndustryNaicsTitles();
        $this->assertArrayHasKey("naics_code", $response[0]);    
        $this->assertArrayHasKey("title", $response[0]);        
        $this->assertArrayHasKey('image', $response[0]);
    }

    // public function test_getIndustryPopulationByRank_returns_all_data()
    // {
    //     $this->seed('University_Majors_TableSeeder');
    //     $this->seed('Naics_Titles_TableSeeder');
    //     $this->seed('Master_Industry_Page_Data_Seeder');   
    //     $response = $this->industryService->getIndustryPopulationByRank(22111, 70);
    //     $this->assertArrayHasKey("title", $response[0]);    
    //     $this->assertArrayHasKey("percentage", $response[0]);        
    //     $this->assertArrayHasKey('rank', $response[0]);
    //     $this->assertArrayHasKey('image', $response[0]);
    // }
}