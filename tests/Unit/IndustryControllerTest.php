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

    protected $retriever = null;
    protected $controller = null;

    public function setUp(){
        parent::setUp();
        $this->retriever = Mockery::spy(IndustryContract::class);
        $this->controller = new IndustryController($this->retriever);
        $this->seed('Naics_Titles_TableSeeder');
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Master_Industry_Path_Types_Table_Seeder');
        $this->seed('Master_Industry_Wages_Table_Seeder');
        $this->seed('Population_Table_Seeder');
        $this->seed('Universities_TableSeeder');
    }

    /**
     * Api route : api/industry/naics-titles
     * method : IndustryController@getAllIndustryNaicsTitles
     * test uses dependency injection 
     */
    public function testGetAllIndustryNaicsTitles()
    {
        $data = json_encode([
            [
                'naics_code' => 1,
                'title' => 'Agriculture, Forestry, Fishing, & Hunting',
                'image' => 'images/industry/agriculture_forestry_fishing_hunting.png'
            ],
        ]);

        $this->retriever
            ->shouldReceive('getAllIndustryNaicsTitles')
            ->once()
            ->andReturn($data);

        $response = $this->controller->getAllIndustryNaicsTitles();
        $this->assertEquals($response,$data);
    }

    /**
     * Api route : api/industry/naics-titles
     * method : IndustryController@getAllIndustryNaicsTitles
     * test assert status
     */
    public function testGetAllIndustryNaicsTitlesReturns200Status()
    {
        $response = $this->json('GET', '/api/industry/naics-titles');
        $response->assertStatus(200);
    }

    /**
     * Api route : api/industry/images/5021/northridge
     * method : IndustryController@testGetIndustryPopulationByRankWithImages
     * test uses dependency injection 
     */
     public function testGetIndustryPopulationByRankWithImages()
     {
        $hegis_code = 5021;
        $universityName = 'northridge';
        $degree = 1;

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
         $this->retriever
         ->shouldReceive('getIndustryPopulationByRankWithImages')
         ->once()
         ->with($hegis_code,$universityName,$degree)
         ->andReturn($data);

        $response = $this->controller->getIndustryPopulationByRankWithImages($hegis_code,$universityName,$degree);
        $this->assertEquals($response,$data);
     }

    /**
     * Api route : api/industry/images/5021/northridge
     * method : IndustryController@testGetIndustryPopulationByRank
     * test uses dependency injection 
     */
    public function testGetIndustryPopulationByRank()
    {
       $hegis_code = 5021;
       $universityName = 'northridge';
       $degree = 1;

       $data = json_encode([
           [
               "title" => "Professional, Scientific, & Technical Skills",
               "percentage" => 42,
               "rank" => 1,
               "industryWage" => 70860
           ],
           [
               "title" => "Finance & Insurance",
               "percentage" => 12,
               "rank" => 2,
               "industryWage" => 71888
           ]
       ]);
        $this->retriever
        ->shouldReceive('getIndustryPopulationByRank')
        ->once()
        ->with($hegis_code,$universityName,$degree)
        ->andReturn($data);

       $response = $this->controller->getIndustryPopulationByRank($hegis_code,$universityName,$degree);
       $this->assertEquals($response,$data);
    }
    
     /**
     * Api route : api/industry/images/5021/northridge
     * method : IndustryController@testGetIndustryPopulationByRankWithImages
     * test assert status
     */
     public function testReturn200StatusGetIndustryPopulationByRankWithImages()
     {
         $response = $this->json('GET', '/api/industry/images/5021/northridge/1');
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

     /**
     * Api route : api/industry/5021/northridge
     * method : IndustryController@testGetIndustryPopulationByRank
     * test assert status
     */
     public function testReturn200GetIndustryPopulationByRank()
     {
         $response = $this->json('GET', '/api/industry/5021/northridge/1');
         $response->assertJsonStructure([
             0 => [
                 'title',
                 'percentage',
                 'rank'
             ]
         ]);
         $response->assertStatus(200);
     }

     /**
      *  Aggregate tests
      *  industry/images/5021/all
      */
      public function test_return_Aggregate_getIndustryPopulationByRankWithImages()
      {
        $hegis = 5021;
        $university = 'all';
        $degreeLevel= 1;

        $firstResult = json_encode([
            [
            "title"=> "Professional, Scientific, & Technical Skills",
            "percentage"=> 40,
            "rank"=> 1,
            "industryWage"=> 69328
            ]
        ]);
        
        $this->retriever
                ->shouldReceive('getIndustryPopulationByRankWithImages')
                ->once()
                ->with($hegis,$university,$degreeLevel)
                ->andReturn($firstResult);

        $response = $this->controller->getIndustryPopulationByRankWithImages($hegis,$university,$degreeLevel);
        $this->assertEquals($firstResult,$response);
      }

      /**
      *  Aggregate tests
      *  industry/5021/all
      */
      public function test_return_Aggregate_expected_count_output_getIndustryPopulationByRank()
      {
        $hegis = 5021;
        $university = 'all';
        $degreeLevel = 1;
        
        $firstResult = json_encode([
            [
            "title"=> "Professional, Scientific, & Technical Skills",
            "percentage"=> 40,
            "rank"=> 1,
            "industryWage"=> 69328
            ]
        ]);
        
        $this->retriever
                ->shouldReceive('getIndustryPopulationByRank')
                ->once()
                ->with($hegis,$university,$degreeLevel)
                ->andReturn($firstResult);

        $response = $this->controller->getIndustryPopulationByRank($hegis,$university,$degreeLevel);
        $this->assertEquals($firstResult,$response);
      }
}