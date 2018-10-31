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

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(IndustryContract::class);
        $this->controller = new IndustryController($this->retriever);
        $this->seed('Naics_Titles_TableSeeder');
        $this->seed('Universities_TableSeeder');

        $this->seed('Aggregate_University_Majors_TableSeeder');
        $this->seed('Aggregate_Industry_Path_Types_TableSeeder');
        $this->seed('Aggregate_Industry_Path_Wages_TableSeeder');
        $this->seed('Aggregate_Industry_Population_TableSeeder');

        $this->seed('Northridge_University_Majors_TableSeeder');
        $this->seed('Northridge_Industry_Path_Types_TableSeeder');
        $this->seed('Northridge_Industry_Path_Wages_TableSeeder');
        $this->seed('Northridge_Industry_Population_TableSeeder');
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
        $this->assertEquals($response, $data);
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
            ->with($hegis_code, $universityName, $degree)
            ->andReturn($data);

        $response = $this->controller->getIndustryPopulationByRankWithImages($hegis_code, $universityName, $degree);
        $this->assertEquals($response, $data);
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
            ->with($hegis_code, $universityName, $degree)
            ->andReturn($data);

        $response = $this->controller->getIndustryPopulationByRank($hegis_code, $universityName, $degree);
        $this->assertEquals($response, $data);
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
        $degreeLevel = 1;

        $firstResult = json_encode([
            [
                "title" => "Professional, Scientific, & Technical Skills",
                "percentage" => 40,
                "rank" => 1,
                "industryWage" => 69328
            ]
        ]);

        $this->retriever
            ->shouldReceive('getIndustryPopulationByRankWithImages')
            ->once()
            ->with($hegis, $university, $degreeLevel)
            ->andReturn($firstResult);

        $response = $this->controller->getIndustryPopulationByRankWithImages($hegis, $university, $degreeLevel);
        $this->assertEquals($firstResult, $response);
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
                "title" => "Professional, Scientific, & Technical Skills",
                "percentage" => 40,
                "rank" => 1,
                "industryWage" => 69328
            ]
        ]);

        $this->retriever
            ->shouldReceive('getIndustryPopulationByRank')
            ->once()
            ->with($hegis, $university, $degreeLevel)
            ->andReturn($firstResult);

            $response = $this->controller->getIndustryPopulationByRank($hegis, $university, $degreeLevel);
            $this->assertEquals($firstResult, $response);
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

          /** call industry wages, hegis code 5021 is accounting */
          /** need to update live data output when we update population percentage */
          $northridge_accounting_wages = $this->json("GET","api/industry/".$northridge_accounting_hegis."/".$northridge_short_name."/1");
          $northridge_accounting_wages = $northridge_accounting_wages->getOriginalContent();
          $northridge_accounting_wages = json_encode($northridge_accounting_wages);

          /** call the industry wage images, hegis code 5021 is accounting */
          $northridge_accounting_images = $this->json("GET","api/industry/images/".$northridge_accounting_hegis."/".$northridge_short_name."/1");
          $northridge_accounting_images = $northridge_accounting_images->getOriginalContent();
          $northridge_accounting_images = json_encode($northridge_accounting_images);

          /** need to update live data output when we update population percentage */
          $northridge_accounting_wages_live_data = json_encode([  [    "title"=> "Agriculture, Forestry, Fishing, & Hunting",    "percentage"=> null,    "rank"=> 1,    "industryWage"=> "39453"  ],  [    "title"=> "Management of Companies & Enterprises",    "percentage"=> null,    "rank"=> 2,    "industryWage"=> "63266"  ],  [    "title"=> "No Wages",    "percentage"=> null,    "rank"=> 3,    "industryWage"=> null  ],  [    "title"=> "Government",    "percentage"=> null,    "rank"=> 4,    "industryWage"=> "71517"  ],  [    "title"=> "Non-Classified",    "percentage"=> null,    "rank"=> 5,    "industryWage"=> null  ],  [    "title"=> "Other Services",    "percentage"=> null,    "rank"=> 6,    "industryWage"=> "55489"  ],  [    "title"=> "Accommodation & Food Services",    "percentage"=> null,    "rank"=> 7,    "industryWage"=> "34202"  ],  [    "title"=> "Arts, Entertainment, & Recreation",    "percentage"=> null,    "rank"=> 8,    "industryWage"=> "69724"  ],  [    "title"=> "Health Care & Social Assistance",    "percentage"=> null,    "rank"=> 9,    "industryWage"=> "49758"  ],  [    "title"=> "Educational Services",    "percentage"=> null,    "rank"=> 10,    "industryWage"=> "58156"  ],  [    "title"=> "Admin & Support & Waste Mgmt & Remediation",    "percentage"=> null,    "rank"=> 11,    "industryWage"=> "55275"  ],  [    "title"=> "Professional, Scientific, & Technical Skills",    "percentage"=> null,    "rank"=> 12,    "industryWage"=> "70860"  ],  [    "title"=> "Mining",    "percentage"=> null,    "rank"=> 13,    "industryWage"=> null  ],  [    "title"=> "Real Estate & Rental & Leasing",    "percentage"=> null,    "rank"=> 14,    "industryWage"=> "67969"  ],  [    "title"=> "Finance & Insurance",    "percentage"=> null,    "rank"=> 15,    "industryWage"=> "71888"  ],  [    "title"=> "Information",    "percentage"=> null,    "rank"=> 16,    "industryWage"=> "67777"  ],  [    "title"=> "Transportation & Warehousing",    "percentage"=> null,    "rank"=> 17,    "industryWage"=> "62164"  ],  [    "title"=> "Retail Trade",    "percentage"=> null,    "rank"=> 18,    "industryWage"=> "53664"  ],  [    "title"=> "Wholesale Trade",    "percentage"=> null,    "rank"=> 19,    "industryWage"=> "53198"  ],  [    "title"=> "Manufacturing",    "percentage"=> null,    "rank"=> 20,    "industryWage"=> "62469"  ],  [    "title"=> "Construction",    "percentage"=> null,    "rank"=> 21,    "industryWage"=> "64448"  ],  [    "title"=> "Utilities",    "percentage"=> null,    "rank"=> 22,    "industryWage"=> "99568"  ],  [    "title"=> "Wages - No NAICS Code",    "percentage"=> null,    "rank"=> 23,    "industryWage"=> "59337"  ]]);
          $northridge_accounting_wages_images_live_data = json_encode([  [    "title"=> "Agriculture, Forestry, Fishing, & Hunting",    "percentage"=> null,    "rank"=> 1,    "image"=> "http://localhost/img/industries/agriculture_forestry_fishing_hunting.png",    "industryWage"=> "39453"  ],  [    "title"=> "Management of Companies & Enterprises",    "percentage"=> null,    "rank"=> 2,    "image"=> "http://localhost/img/industries/management_of_companies_enterprises.png",    "industryWage"=> "63266"  ],  [    "title"=> "No Wages",    "percentage"=> null,    "rank"=> 3,    "image"=> "http://localhost/img/industries/no_wages.png",    "industryWage"=> null  ],  [    "title"=> "Government",    "percentage"=> null,    "rank"=> 4,    "image"=> "http://localhost/img/industries/government.png",    "industryWage"=> "71517"  ],  [    "title"=> "Non-Classified",    "percentage"=> null,    "rank"=> 5,    "image"=> "http://localhost/img/industries/non-classified.png",    "industryWage"=> null  ],  [    "title"=> "Other Services",    "percentage"=> null,    "rank"=> 6,    "image"=> "http://localhost/img/industries/other_services.png",    "industryWage"=> "55489"  ],  [    "title"=> "Accommodation & Food Services",    "percentage"=> null,    "rank"=> 7,    "image"=> "http://localhost/img/industries/accommodation_food_services.png",    "industryWage"=> "34202"  ],  [    "title"=> "Arts, Entertainment, & Recreation",    "percentage"=> null,    "rank"=> 8,    "image"=> "http://localhost/img/industries/arts_entertainment_recreation.png",    "industryWage"=> "69724"  ],  [    "title"=> "Health Care & Social Assistance",    "percentage"=> null,    "rank"=> 9,    "image"=> "http://localhost/img/industries/health_care_social_assistance.png",    "industryWage"=> "49758"  ],  [    "title"=> "Educational Services",    "percentage"=> null,    "rank"=> 10,    "image"=> "http://localhost/img/industries/educational_services.png",    "industryWage"=> "58156"  ],  [    "title"=> "Admin & Support & Waste Mgmt & Remediation",    "percentage"=> null,    "rank"=> 11,    "image"=> "http://localhost/img/industries/admin_support_waste_mgmt_remediation.png",    "industryWage"=> "55275"  ],  [    "title"=> "Professional, Scientific, & Technical Skills",    "percentage"=> null,    "rank"=> 12,    "image"=> "http://localhost/img/industries/professional_scientific_technical_skills.png",    "industryWage"=> "70860"  ],  [    "title"=> "Mining",    "percentage"=> null,    "rank"=> 13,    "image"=> "http://localhost/img/industries/mining.png",    "industryWage"=> null  ],  [    "title"=> "Real Estate & Rental & Leasing",    "percentage"=> null,    "rank"=> 14,    "image"=> "http://localhost/img/industries/real_estate_rental_leasing.png",    "industryWage"=> "67969"  ],  [    "title"=> "Finance & Insurance",    "percentage"=> null,    "rank"=> 15,    "image"=> "http://localhost/img/industries/finance_insurance.png",    "industryWage"=> "71888"  ],  [    "title"=> "Information",    "percentage"=> null,    "rank"=> 16,    "image"=> "http://localhost/img/industries/information.png",    "industryWage"=> "67777"  ],  [    "title"=> "Transportation & Warehousing",    "percentage"=> null,    "rank"=> 17,    "image"=> "http://localhost/img/industries/transportation_warehousing.png",    "industryWage"=> "62164"  ],  [    "title"=> "Retail Trade",    "percentage"=> null,    "rank"=> 18,    "image"=> "http://localhost/img/industries/retail_trade.png",    "industryWage"=> "53664"  ],  [    "title"=> "Wholesale Trade",    "percentage"=> null,    "rank"=> 19,    "image"=> "http://localhost/img/industries/wholesale_trade.png",    "industryWage"=> "53198"  ],  [    "title"=> "Manufacturing",    "percentage"=> null,    "rank"=> 20,    "image"=> "http://localhost/img/industries/manufacturing.png",    "industryWage"=> "62469"  ],  [    "title"=> "Construction",    "percentage"=> null,    "rank"=> 21,    "image"=> "http://localhost/img/industries/construction.png",    "industryWage"=> "64448"  ],  [    "title"=> "Utilities",    "percentage"=> null,    "rank"=> 22,    "image"=> "http://localhost/img/industries/utilities.png",    "industryWage"=> "99568"  ],  [    "title"=> "Wages - No NAICS Code",    "percentage"=> null,    "rank"=> 23,    "image"=> "http://localhost/img/industries/wages_-_no_naics_code.png",    "industryWage"=> "59337"  ]]);
          $this->assertEquals($northridge_accounting_wages,$northridge_accounting_wages_live_data);
          $this->assertEquals($northridge_accounting_images,$northridge_accounting_wages_images_live_data);
    
          /** test if both accounting data are equal */
          $northridge_accounting_wages = json_decode($northridge_accounting_wages,true);
          $northridge_accounting_images = json_decode($northridge_accounting_images,true);
  
          foreach($northridge_accounting_wages as $iterate => $northridge_accounting_images)
          {
              $this->assertEquals($data[$iterate]['rank'], $northridge_accounting_images['rank']);
              $this->assertEquals($data[$iterate]['title'], $northridge_accounting_images['title']);
              $this->assertEquals($data[$iterate]['industryWage'], $northridge_accounting_images['industryWage']);
          }

          /** aggregate testing with  */



      }
}