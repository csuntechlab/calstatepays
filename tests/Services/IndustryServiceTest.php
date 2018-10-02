<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Services\IndustryService;
use App\Contracts\HelperContract;
use Mockery;
use Tests\TestCase;


class IndustryServiceTest extends TestCase
{
    use DatabaseMigrations;
    protected $industryService;
    protected $helperRetriever;

    public function setUp()
    {
        parent::setUp();
        $this->helperRetriever = Mockery::spy(HelperContract::class);
        $this->seed('Naics_Titles_TableSeeder');
    }

    public function test_getAllIndustryNaicsTitles_returns_all_rows()
    {
        // route is api/industry/naics-titles
        $industryService = new IndustryService($this->helperRetriever);
        $response = $industryService->getAllIndustryNaicsTitles();
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

        $opt_in_data = [
            "id" => "70",
            "university_name" => "Northridge",
            "opt_in" => 1
         ];

         $university_id = 70;

         $this->helperRetriever
            ->shouldReceive('checkOptIn')
            ->once()
            ->with($university_id)
            ->andReturn($opt_in_data);

        $industryService = new IndustryService($this->helperRetriever);

         $response = $industryService->getIndustryPopulationByRank(22111, 70);
         $this->assertArrayHasKey("title", $response[0]);
         $this->assertArrayHasKey("percentage", $response[0]);
         $this->assertArrayHasKey('rank', $response[0]);
         $this->assertArrayHasKey('image', $response[0]);
     }
}