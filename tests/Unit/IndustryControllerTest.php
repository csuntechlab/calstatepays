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

      public function test_IndustryTestController(){

          $titles = $this->json('GET','api/industry/naics-titles');
          $titles = $titles->getOriginalContent();
          $this->assertArrayHasKey('naics_code', $titles[0]);
          $this->assertArrayHasKey('title', $titles[0]);
          $this->assertArrayHasKey('image', $titles[0]);
          $this->assertStringEndsWith('.png', $titles[0]['image']);
            
          /** test the count */
          $count = count($titles);
          $this->assertEquals(23,$count);
          
          /** test the exception */
          $fail = $this->json('GET','api/industry/43244/northridge/1');
          $code = $fail->original['code'];
          $this->assertFalse($fail->original['success']);
          $this->assertEquals(409,$code);

          /** test successful industry call */
          $success =  $this->json('GET','api/industry/5021/northridge/1');
          $success->assertStatus(200);
          $success = $success->getOriginalContent();

          /** test the industry image call */
          $industryImage = $this->json('GET','api/industry/5021/northridge/1');
          $industryImage->assertStatus(200);
          $data = $industryImage->getOriginalContent();

          /** make sure that image data == industry data */
          foreach($data as $iterate => $success)
          {
            $this->assertEquals($data[$iterate]['rank'], $success['rank']);
            $this->assertEquals($data[$iterate]['title'], $success['title']);
            $this->assertEquals($data[$iterate]['industryWage'], $success['industryWage']);
          }

          /** make a api industry api call with other api calls  */

          $university_call = $this->json("GET","api/university");
          $university_call = $university_call->getOriginalContent();

          /** test with northridge */
          $northridge = $university_call[5];
          $northridge_short_name = $northridge['short_name'];

          /** get hegis codes */
          $northridge_hegis = $this->json("GET","api/major/hegis-codes/university/".$northridge_short_name);
          $northridge_hegis = $northridge_hegis->getOriginalContent();

          $northridge_accounting_hegis = $northridge_hegis[0]['hegis_code'];

          /** call industry wages */
          $northridge_accounting_wages = $this->json("GET","api/industry/".$northridge_accounting_hegis."/".$northridge_short_name."/1");
          $northridge_accounting_wages = $northridge_accounting_wages->getOriginalContent();
          $northridge_accounting_wages = json_encode($northridge_accounting_wages);


          $northridge_accounting_wages_live_data = json_encode([[  "title"=> "Professional, Scientific, & Technical Skills",  "percentage"=> 40,  "rank"=> 1,  "industryWage"=> null],[  "title"=> "Finance & Insurance",  "percentage"=> 11,  "rank"=> 2,  "industryWage"=> null],[  "title"=> "Information",  "percentage"=> 6,  "rank"=> 3,  "industryWage"=> null],[  "title"=> "Admin & Support & Waste Mgmt & Remediation",  "percentage"=> 6,  "rank"=> 4,  "industryWage"=> null],[  "title"=> "Wages - No NAICS Code",  "percentage"=> 5,  "rank"=> 5,  "industryWage"=> 48541],[  "title"=> "Government",  "percentage"=> 5,  "rank"=> 6,  "industryWage"=> null],[  "title"=> "Manufacturing",  "percentage"=> 4,  "rank"=> 7,  "industryWage"=> null],[  "title"=> "Real Estate & Rental & Leasing",  "percentage"=> 4,  "rank"=> 8,  "industryWage"=> null],[  "title"=> "Health Care & Social Assistance",  "percentage"=> 3,  "rank"=> 9,  "industryWage"=> null],[  "title"=> "Retail Trade",  "percentage"=> 3,  "rank"=> 10,  "industryWage"=> 26395],[  "title"=> "Wholesale Trade",  "percentage"=> 3,  "rank"=> 11,  "industryWage"=> 63012],[  "title"=> "Educational Services",  "percentage"=> 2,  "rank"=> 12,  "industryWage"=> 12295],[  "title"=> "Other Services",  "percentage"=> 1,  "rank"=> 13,  "industryWage"=> null],[  "title"=> "Construction",  "percentage"=> 1,  "rank"=> 14,  "industryWage"=> null],[  "title"=> "Accommodation & Food Services",  "percentage"=> 1,  "rank"=> 15,  "industryWage"=> null],[  "title"=> "Transportation & Warehousing",  "percentage"=> 1,  "rank"=> 16,  "industryWage"=> 44667],[  "title"=> "Arts, Entertainment, & Recreation",  "percentage"=> 1,  "rank"=> 17,  "industryWage"=> 49380],[  "title"=> "Management of Companies & Enterprises",  "percentage"=> 1,  "rank"=> 18,  "industryWage"=> 79253],[  "title"=> "Utilities",  "percentage"=> 0,  "rank"=> 19,  "industryWage"=> null],[  "title"=> "Agriculture, Forestry, Fishing, & Hunting",  "percentage"=> 0,  "rank"=> 20,  "industryWage"=> 44893],[  "title"=> "No Wages",  "percentage"=> 0,  "rank"=> 21,  "industryWage"=> null],[  "title"=> "Mining",  "percentage"=> null,  "rank"=> 22,  "industryWage"=> null],[  "title"=> "Non-Classified",  "percentage"=> null,  "rank"=> 23,  "industryWage"=> null],[  "title"=> "Professional, Scientific, & Technical Skills",  "percentage"=> 40,  "rank"=> 1,  "industryWage"=> null],[  "title"=> "Finance & Insurance",  "percentage"=> 11,  "rank"=> 2,  "industryWage"=> null],[  "title"=> "Information",  "percentage"=> 6,  "rank"=> 3,  "industryWage"=> null],[  "title"=> "Admin & Support & Waste Mgmt & Remediation",  "percentage"=> 6,  "rank"=> 4,  "industryWage"=> null],[  "title"=> "Wages - No NAICS Code",  "percentage"=> 5,  "rank"=> 5,  "industryWage"=> 48541],[  "title"=> "Government",  "percentage"=> 5,  "rank"=> 6,  "industryWage"=> null],[  "title"=> "Manufacturing",  "percentage"=> 4,  "rank"=> 7,  "industryWage"=> null],[  "title"=> "Real Estate & Rental & Leasing",  "percentage"=> 4,  "rank"=> 8,  "industryWage"=> null],[  "title"=> "Health Care & Social Assistance",  "percentage"=> 3,  "rank"=> 9,  "industryWage"=> null],[  "title"=> "Retail Trade",  "percentage"=> 3,  "rank"=> 10,  "industryWage"=> 26395],[  "title"=> "Wholesale Trade",  "percentage"=> 3,  "rank"=> 11,  "industryWage"=> 63012],[  "title"=> "Educational Services",  "percentage"=> 2,  "rank"=> 12,  "industryWage"=> 12295],[  "title"=> "Other Services",  "percentage"=> 1,  "rank"=> 13,  "industryWage"=> null],[  "title"=> "Construction",  "percentage"=> 1,  "rank"=> 14,  "industryWage"=> null],[  "title"=> "Accommodation & Food Services",  "percentage"=> 1,  "rank"=> 15,  "industryWage"=> null],[  "title"=> "Transportation & Warehousing",  "percentage"=> 1,  "rank"=> 16,  "industryWage"=> 44667],[  "title"=> "Arts, Entertainment, & Recreation",  "percentage"=> 1,  "rank"=> 17,  "industryWage"=> 49380],[  "title"=> "Management of Companies & Enterprises",  "percentage"=> 1,  "rank"=> 18,  "industryWage"=> 79253],[  "title"=> "Utilities",  "percentage"=> 0,  "rank"=> 19,  "industryWage"=> null],[  "title"=> "Agriculture, Forestry, Fishing, & Hunting",  "percentage"=> 0,  "rank"=> 20,  "industryWage"=> 44893],[  "title"=> "No Wages",  "percentage"=> 0,  "rank"=> 21,  "industryWage"=> null],[  "title"=> "Mining",  "percentage"=> null,  "rank"=> 22,  "industryWage"=> null],[  "title"=> "Non-Classified",  "percentage"=> null,  "rank"=> 23,  "industryWage"=> null]]);

          $this->assertEquals($northridge_accounting_wages,$northridge_accounting_wages_live_data);
        //   dd($northridge_accounting_hegis);


        //   $major = $success[0]['']
      }
}