<?php

namespace Tests;

use App\Models\NaicsTitle;
use App\Models\UniversityMajor;
use App\Models\IndustryPathType;
use App\Models\Population;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Controllers\IndustryController;
use App\Contracts\IndustryContract;
use Mockery;

class IndustryControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected $industryContract = null;

    public function setUp(){
        parent::setUp();
        $this->industryContract = Mockery::spy(IndustryContract::class);
    }

    public function testGetAllIndustryNaicsTitles()
    {
        $data = json_encode([
            [
                'naics_code' => 1,
                'title' => 'Agriculture, Forestry, Fishing, & Hunting',
                'image' => 'images/industry/agriculture_forestry_fishing_hunting.png'
            ],
        ]);

        // api route is
        // /api/industry/naics-titles
        // method is IndustryContrller@getAllIndustryNaicsTitles
        $this->industryContract
            ->shouldReceive('getAllIndustryNaicsTitles')
            ->once()
            ->andReturn($data);

        $controller = new IndustryController($this->industryContract);
        $response = $controller->getAllIndustryNaicsTitles();
        $this->assertEquals($response,$data);
    }

    public function testGetAllIndustryNaicsTitlesReturns200Status()
    {
        $this->seed('Naics_Titles_TableSeeder');
        $response = $this->json('GET', '/api/industry/naics-titles');
        $response->assertStatus(200);
    }

     public function testGetIndustryPopulationByRankWithImages()
     {
        $hegis_code = 5021;
        $universityName = 'northridge';

        $data = json_encode([
            [
                "title" => "Professional, Scientific, & Technical Skills",
                "percentage" => 42,
                "rank" => 1,
                "image" => "http://localhost:8888/metalab/CSU-Metro-LA/public/img/industries/professional_scientific_technical_skills.png",
                "industryWage" => 70860
            ],
            [
                "title" => "Finance & Insurance",
                "percentage" => 12,
                "rank" => 2,
                "image" => "http://localhost:8888/metalab/CSU-Metro-LA/public/img/industries/finance_insurance.png",
                "industryWage" => 71888
            ]
        ]);
        
         // route is
         // /api/industry/5021/northridge
         // method is IndustryContrller@getIndustryPopulationByRankWithImages
         $this->industryContract
         ->shouldReceive('getIndustryPopulationByRankWithImages')
         ->once()
         ->with($hegis_code,$universityName)
         ->andReturn($data);

        $controller = new IndustryController($this->industryContract);
        $response = $controller->getIndustryPopulationByRankWithImages($hegis_code,$universityName);
        $this->assertEquals($response,$data);

     }

     public function testReturns200StatusGetIndustryPopulationByRankWithImages()
     {
         // route is
         // /api/industry/5021/northridge
         // method is IndustryContrller@getIndustryPopulationByRankWithImages
         $this->seed('University_Majors_TableSeeder');
         $this->seed('Master_Industry_Path_Types_Table_Seeder');
         $this->seed('Master_Industry_Wages_Table_Seeder');
         $this->seed('Population_Table_Seeder');
         $this->seed('Universities_TableSeeder');
         $response = $this->json('GET', '/api/industry/images/5021/northridge');
         $response->assertJsonStructure([
             0 => [
                 'title',
                 'percentage',
                 'rank',
                 'image'
             ]
         ]);
         $response->assertStatus(200);
     }
     
     public function testGetIndustryPopulationByRank()
     {
         // route is
         // /api/industry/5021/northridge
         // method is IndustryContrller@getIndustryPopulationByRankWithImages
         $this->seed('University_Majors_TableSeeder');
         $this->seed('Master_Industry_Path_Types_Table_Seeder');
         $this->seed('Master_Industry_Wages_Table_Seeder');
         $this->seed('Population_Table_Seeder');
         $this->seed('Universities_TableSeeder');
         $response = $this->json('GET', '/api/industry/5021/northridge');
         $response->assertJsonStructure([
             0 => [
                 'title',
                 'percentage',
                 'rank'
             ]
         ]);
         $response->assertStatus(200);
     }
}