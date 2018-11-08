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
use App\Http\Requests\IndustryFormRequest;
use Illuminate\Support\Facades\Validator;

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
        $input = [
            'major' => 5021,
            'university' => 'northridge',
            'degreeLevel' => 1
        ];

        $request = new IndustryFormRequest($input);

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
            ->with($request->major, $request->university, $request->degreeLevel)
            ->andReturn($data);

        $response = $this->controller->getIndustryPopulationByRankWithImages($request);
        $this->assertEquals($response, $data);
    }

    /**
     * Api route : api/industry/images/5021/northridge
     * method : IndustryController@testGetIndustryPopulationByRank
     * test uses dependency injection 
     */
    public function testGetIndustryPopulationByRank()
    {
        $input = [
            'major' => 5021,
            'university' => 'northridge',
            'degreeLevel' => 1
        ];

        $request = new IndustryFormRequest($input);

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
            ->with($request->hegis_code, $request->universityName, $request->degreeLevel)
            ->andReturn($data);

        $response = $this->controller->getIndustryPopulationByRank($request);
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
        $input = [
            'hegis' => 5021,
            'university' => 'all',
            'degreeLevel' => 1,
        ];

        $request = new IndustryFormRequest($input);

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
            ->with($request->hegis, $request->university, $request->degreeLevel)
            ->andReturn($firstResult);

        $response = $this->controller->getIndustryPopulationByRankWithImages($request);
        $this->assertEquals($firstResult, $response);
    }

    /**
     *  Aggregate tests
     *  industry/5021/all
     */
    public function test_return_Aggregate_expected_count_output_getIndustryPopulationByRank()
    {

        $input = [
            'hegis' => 5021,
            'university' => 'all',
            'degreeLevel' => 1,
        ];

        $request = new IndustryFormRequest($input);

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
            ->with($request->hegis, $request->university, $request->degreeLevel)
            ->andReturn($firstResult);

        $response = $this->controller->getIndustryPopulationByRank($request);
        $this->assertEquals($firstResult, $response);
    }

    public function test_Validator()
    {
        $input = [
            'major' => 5021,
            'university' => 'northridge',
            'degreeLevel' => 1
        ];

         // test the validator
        $request = new IndustryFormRequest($input);
        $rules = $request->rules();
        $validator = Validator::make($input, $rules);
        $fails = $validator->fails();
    }

    public function test_IndustryTestController()
    {

        $titles = $this->json('GET', 'api/industry/naics-titles');
        $titles = $titles->getOriginalContent();
        $this->assertArrayHasKey('naics_code', $titles[0]);
        $this->assertArrayHasKey('title', $titles[0]);
        $this->assertArrayHasKey('image', $titles[0]);
        $this->assertStringEndsWith('.png', $titles[0]['image']);

        /** test the count */
        $count = count($titles);
        $this->assertEquals(22, $count);

        /** test the exception */
        $fail = $this->json('GET', 'api/industry/43244/northridge/1');
        $code = $fail->original['code'];
        $this->assertFalse($fail->original['success']);
        $this->assertEquals(409, $code);

        /** test successful industry call */
        $success = $this->json('GET', 'api/industry/5021/northridge/1');
        $success->assertStatus(200);
        $success = $success->getOriginalContent();

        /** test the industry image call */
        $industryImage = $this->json('GET', 'api/industry/5021/northridge/1');
        $industryImage->assertStatus(200);
        $data = $industryImage->getOriginalContent();

        /** make sure that image data == industry data */
        foreach ($data as $iterate => $success) {
            $this->assertEquals($data[$iterate]['rank'], $success['rank']);
            $this->assertEquals($data[$iterate]['title'], $success['title']);
            $this->assertEquals($data[$iterate]['industryWage'], $success['industryWage']);
        }

        //   /** make a api industry api call with other api calls  */

        //   $university_call = $this->json("GET","api/university");
        //   $university_call = $university_call->getOriginalContent();

        //   /** test with northridge */
        //   $northridge = $university_call[5];
        //   $northridge_short_name = $northridge['short_name'];

        //   /** get hegis codes */
        //   $northridge_hegis = $this->json("GET","api/major/hegis-codes/university/".$northridge_short_name);
        //   $northridge_hegis = $northridge_hegis->getOriginalContent();

        //   $northridge_accounting_hegis = $northridge_hegis[0]['hegis_code'];

        //   /** call industry wages, hegis code 5021 is accounting */
        //   /** need to update live data output when we update population percentage */
        //   $northridge_accounting_wages = $this->json("GET","api/industry/".$northridge_accounting_hegis."/".$northridge_short_name."/1");
        //   $northridge_accounting_wages = $northridge_accounting_wages->getOriginalContent();
        //   $northridge_accounting_wages = json_encode($northridge_accounting_wages);

        //   /** call the industry wage images, hegis code 5021 is accounting */
        //   $northridge_accounting_images = $this->json("GET","api/industry/images/".$northridge_accounting_hegis."/".$northridge_short_name."/1");
        //   $northridge_accounting_images = $northridge_accounting_images->getOriginalContent();
        //   $northridge_accounting_images = json_encode($northridge_accounting_images);

        //   $northridge_accounting_wages_live_data = json_encode([  [    "title"=> "Professional, Scientific, & Technical Skills",    "percentage"=> 40.12,    "rank"=> 1,    "industryWage"=> "73073"  ],  [    "title"=> "Finance & Insurance",    "percentage"=> 11.44,    "rank"=> 2,    "industryWage"=> "71273"  ],  [    "title"=> "Information",    "percentage"=> 5.93,    "rank"=> 3,    "industryWage"=> "69891"  ],  [    "title"=> "Admin & Support & Waste Mgmt & Remediation",    "percentage"=> 5.93,    "rank"=> 4,    "industryWage"=> "56906"  ],  [    "title"=> "Wages - No NAICS Code",    "percentage"=> 5.11,    "rank"=> 5,    "industryWage"=> "61763"  ],  [    "title"=> "Government",    "percentage"=> 4.9,    "rank"=> 6,    "industryWage"=> "67599"  ],  [    "title"=> "Manufacturing",    "percentage"=> 3.95,    "rank"=> 7,    "industryWage"=> "64325"  ],  [    "title"=> "Real Estate & Rental & Leasing",    "percentage"=> 3.75,    "rank"=> 8,    "industryWage"=> "64247"  ],  [    "title"=> "Health Care & Social Assistance",    "percentage"=> 3.27,    "rank"=> 9,    "industryWage"=> "45465"  ],  [    "title"=> "Retail Trade",    "percentage"=> 3.2,    "rank"=> 10,    "industryWage"=> "50401"  ],  [    "title"=> "Wholesale Trade",    "percentage"=> 2.72,    "rank"=> 11,    "industryWage"=> "51746"  ],  [    "title"=> "Educational Services",    "percentage"=> 2.38,    "rank"=> 12,    "industryWage"=> "55619"  ],  [    "title"=> "Other Services",    "percentage"=> 1.5,    "rank"=> 13,    "industryWage"=> "59447"  ],  [    "title"=> "Construction",    "percentage"=> 1.23,    "rank"=> 14,    "industryWage"=> "71184"  ],  [    "title"=> "Accommodation & Food Services",    "percentage"=> 1.23,    "rank"=> 15,    "industryWage"=> "37452"  ],  [    "title"=> "Transportation & Warehousing",    "percentage"=> 1.02,    "rank"=> 16,    "industryWage"=> "73398"  ],  [    "title"=> "Arts, Entertainment, & Recreation",    "percentage"=> 0.75,    "rank"=> 17,    "industryWage"=> "46897"  ],  [    "title"=> "Management of Companies & Enterprises",    "percentage"=> 0.61,    "rank"=> 18,    "industryWage"=> "61578"  ],  [    "title"=> "Utilities",    "percentage"=> 0.48,    "rank"=> 19,    "industryWage"=> "101415"  ],  [    "title"=> "Agriculture, Forestry, Fishing, & Hunting",    "percentage"=> 0.41,    "rank"=> 20,    "industryWage"=> "45313"  ],  [    "title"=> "No Wages",    "percentage"=> 0.07,    "rank"=> 21,    "industryWage"=> null  ],  [    "title"=> "Mining",    "percentage"=> 0,    "rank"=> 22,    "industryWage"=> null  ],  [    "title"=> "Non-Classified",    "percentage"=> 0,    "rank"=> 23,    "industryWage"=> null  ]]);
        //   $northridge_accounting_wages_images_live_data = json_encode([  [    "title"=> "Professional, Scientific, & Technical Skills",    "percentage"=> 40.12,    "rank"=> 1,    "image"=> "http://localhost/img/industries/professional_scientific_technical_skills.png",    "industryWage"=> "73073"  ],  [    "title"=> "Finance & Insurance",    "percentage"=> 11.44,    "rank"=> 2,    "image"=> "http://localhost/img/industries/finance_insurance.png",    "industryWage"=> "71273"  ],  [    "title"=> "Information",    "percentage"=> 5.93,    "rank"=> 3,    "image"=> "http://localhost/img/industries/information.png",    "industryWage"=> "69891"  ],  [    "title"=> "Admin & Support & Waste Mgmt & Remediation",    "percentage"=> 5.93,    "rank"=> 4,    "image"=> "http://localhost/img/industries/admin_support_waste_mgmt_remediation.png",    "industryWage"=> "56906"  ],  [    "title"=> "Wages - No NAICS Code",    "percentage"=> 5.11,    "rank"=> 5,    "image"=> "http://localhost/img/industries/wages_-_no_naics_code.png",    "industryWage"=> "61763"  ],  [    "title"=> "Government",    "percentage"=> 4.9,    "rank"=> 6,    "image"=> "http://localhost/img/industries/government.png",    "industryWage"=> "67599"  ],  [    "title"=> "Manufacturing",    "percentage"=> 3.95,    "rank"=> 7,    "image"=> "http://localhost/img/industries/manufacturing.png",    "industryWage"=> "64325"  ],  [    "title"=> "Real Estate & Rental & Leasing",    "percentage"=> 3.75,    "rank"=> 8,    "image"=> "http://localhost/img/industries/real_estate_rental_leasing.png",    "industryWage"=> "64247"  ],  [    "title"=> "Health Care & Social Assistance",    "percentage"=> 3.27,    "rank"=> 9,    "image"=> "http://localhost/img/industries/health_care_social_assistance.png",    "industryWage"=> "45465"  ],  [    "title"=> "Retail Trade",    "percentage"=> 3.2,    "rank"=> 10,    "image"=> "http://localhost/img/industries/retail_trade.png",    "industryWage"=> "50401"  ],  [    "title"=> "Wholesale Trade",    "percentage"=> 2.72,    "rank"=> 11,    "image"=> "http://localhost/img/industries/wholesale_trade.png",    "industryWage"=> "51746"  ],  [    "title"=> "Educational Services",    "percentage"=> 2.38,    "rank"=> 12,    "image"=> "http://localhost/img/industries/educational_services.png",    "industryWage"=> "55619"  ],  [    "title"=> "Other Services",    "percentage"=> 1.5,    "rank"=> 13,    "image"=> "http://localhost/img/industries/other_services.png",    "industryWage"=> "59447"  ],  [    "title"=> "Construction",    "percentage"=> 1.23,    "rank"=> 14,    "image"=> "http://localhost/img/industries/construction.png",    "industryWage"=> "71184"  ],  [    "title"=> "Accommodation & Food Services",    "percentage"=> 1.23,    "rank"=> 15,    "image"=> "http://localhost/img/industries/accommodation_food_services.png",    "industryWage"=> "37452"  ],  [    "title"=> "Transportation & Warehousing",    "percentage"=> 1.02,    "rank"=> 16,    "image"=> "http://localhost/img/industries/transportation_warehousing.png",    "industryWage"=> "73398"  ],  [    "title"=> "Arts, Entertainment, & Recreation",    "percentage"=> 0.75,    "rank"=> 17,    "image"=> "http://localhost/img/industries/arts_entertainment_recreation.png",    "industryWage"=> "46897"  ],  [    "title"=> "Management of Companies & Enterprises",    "percentage"=> 0.61,    "rank"=> 18,    "image"=> "http://localhost/img/industries/management_of_companies_enterprises.png",    "industryWage"=> "61578"  ],  [    "title"=> "Utilities",    "percentage"=> 0.48,    "rank"=> 19,    "image"=> "http://localhost/img/industries/utilities.png",    "industryWage"=> "101415"  ],  [    "title"=> "Agriculture, Forestry, Fishing, & Hunting",    "percentage"=> 0.41,    "rank"=> 20,    "image"=> "http://localhost/img/industries/agriculture_forestry_fishing_hunting.png",    "industryWage"=> "45313"  ],  [    "title"=> "No Wages",    "percentage"=> 0.07,    "rank"=> 21,    "image"=> "http://localhost/img/industries/no_wages.png",    "industryWage"=> null  ],  [    "title"=> "Mining",    "percentage"=> 0,    "rank"=> 22,    "image"=> "http://localhost/img/industries/mining.png",    "industryWage"=> null  ],  [    "title"=> "Non-Classified",    "percentage"=> 0,    "rank"=> 23,    "image"=> "http://localhost/img/industries/non-classified.png",    "industryWage"=> null  ]]);
          
        //   $this->assertEquals($northridge_accounting_wages,$northridge_accounting_wages_live_data);
        //   $this->assertEquals($northridge_accounting_images,$northridge_accounting_wages_images_live_data);
    
        //   /** test if both accounting data are equal */
        //   $northridge_accounting_wages = json_decode($northridge_accounting_wages,true);
        //   $northridge_accounting_images = json_decode($northridge_accounting_images,true);
  
        //   foreach($northridge_accounting_wages as $iterate => $northridge_accounting_images)
        //   {
        //       $this->assertEquals($data[$iterate]['rank'], $northridge_accounting_images['rank']);
        //       $this->assertEquals($data[$iterate]['title'], $northridge_accounting_images['title']);
        //       $this->assertEquals($data[$iterate]['industryWage'], $northridge_accounting_images['industryWage']);
        //   }

        //   /** aggregate testing with 8351 Kinseology major  */
        //   $aggregate = $university_call[7];
        //   $aggregate_short_name = $northridge['short_name'];

        //   /** get hegis codes */
        //   $aggregate_hegis = $this->json("GET","api/major/hegis-codes/university/".$aggregate_short_name);
        //   $aggregate_hegis = $aggregate_hegis->getOriginalContent();
        //   $aggregate_kinseology_hegis = $aggregate_hegis[48]['hegis_code'];

        //   /** call the industry api with aggregate short name and 8351 */
        //   $aggregate_kinseology_wages = $this->json("GET","api/industry/".$aggregate_kinseology_hegis."/".$aggregate_short_name."/1");
        //   $aggregate_kinseology_wages = $aggregate_kinseology_wages->getOriginalContent();
        //   $aggregate_kinseology_wages = json_encode($aggregate_kinseology_wages);

        //   /** call the industry wage images, hegis code 8351, kinseology*/
        //   $aggregate_kinseology_images = $this->json("GET","api/industry/images/".$aggregate_kinseology_hegis."/".$aggregate_short_name."/1");
        //   $aggregate_kinseology_images = $aggregate_kinseology_images->getOriginalContent();
        //   $aggregate_kinseology_images = json_encode($aggregate_kinseology_images);

        //   $aggregate_kinseology_live_wage_data = json_encode([  [    "title"=> "Educational Services",    "percentage"=> 22.77,    "rank"=> 1,    "industryWage"=> "51097"  ],  [    "title"=> "Health Care & Social Assistance",    "percentage"=> 20,    "rank"=> 2,    "industryWage"=> "34524"  ],  [    "title"=> "Arts, Entertainment, & Recreation",    "percentage"=> 8.1,    "rank"=> 3,    "industryWage"=> "30017"  ],  [    "title"=> "Government",    "percentage"=> 8,    "rank"=> 4,    "industryWage"=> "65825"  ],  [    "title"=> "Retail Trade",    "percentage"=> 5.54,    "rank"=> 5,    "industryWage"=> "35957"  ],  [    "title"=> "Wages - No NAICS Code",    "percentage"=> 4.92,    "rank"=> 6,    "industryWage"=> "10342"  ],  [    "title"=> "Accommodation & Food Services",    "percentage"=> 4.41,    "rank"=> 7,    "industryWage"=> "22722"  ],  [    "title"=> "Admin & Support & Waste Mgmt & Remediation",    "percentage"=> 4.1,    "rank"=> 8,    "industryWage"=> "33461"  ],  [    "title"=> "Other Services",    "percentage"=> 4.1,    "rank"=> 9,    "industryWage"=> "29187"  ],  [    "title"=> "Finance & Insurance",    "percentage"=> 3.08,    "rank"=> 10,    "industryWage"=> "51867"  ],  [    "title"=> "Professional, Scientific, & Technical Skills",    "percentage"=> 3.08,    "rank"=> 11,    "industryWage"=> "46106"  ],  [    "title"=> "Wholesale Trade",    "percentage"=> 2.67,    "rank"=> 12,    "industryWage"=> "58381"  ],  [    "title"=> "Information",    "percentage"=> 2.46,    "rank"=> 13,    "industryWage"=> "28713"  ],  [    "title"=> "Manufacturing",    "percentage"=> 1.85,    "rank"=> 14,    "industryWage"=> "52236"  ],  [    "title"=> "Real Estate & Rental & Leasing",    "percentage"=> 1.74,    "rank"=> 15,    "industryWage"=> "47061"  ],  [    "title"=> "Construction",    "percentage"=> 1.64,    "rank"=> 16,    "industryWage"=> "39117"  ],  [    "title"=> "Transportation & Warehousing",    "percentage"=> 1.44,    "rank"=> 17,    "industryWage"=> "45455"  ],  [    "title"=> "No Wages",    "percentage"=> 0.1,    "rank"=> 18,    "industryWage"=> null  ],  [    "title"=> "Agriculture, Forestry, Fishing, & Hunting",    "percentage"=> 0,    "rank"=> 19,    "industryWage"=> null  ],  [    "title"=> "Non-Classified",    "percentage"=> 0,    "rank"=> 20,    "industryWage"=> null  ],  [    "title"=> "Utilities",    "percentage"=> 0,    "rank"=> 21,    "industryWage"=> null  ],  [    "title"=> "Management of Companies & Enterprises",    "percentage"=> 0,    "rank"=> 22,    "industryWage"=> null  ]]);
        //   $aggregate_kinseology_live_images_data = json_encode([  [    "title"=> "Educational Services",    "percentage"=> 22.77,    "rank"=> 1,    "image"=> "http://localhost/img/industries/educational_services.png",    "industryWage"=> "51097"  ],  [    "title"=> "Health Care & Social Assistance",    "percentage"=> 20,    "rank"=> 2,    "image"=> "http://localhost/img/industries/health_care_social_assistance.png",    "industryWage"=> "34524"  ],  [    "title"=> "Arts, Entertainment, & Recreation",    "percentage"=> 8.1,    "rank"=> 3,    "image"=> "http://localhost/img/industries/arts_entertainment_recreation.png",    "industryWage"=> "30017"  ],  [    "title"=> "Government",    "percentage"=> 8,    "rank"=> 4,    "image"=> "http://localhost/img/industries/government.png",    "industryWage"=> "65825"  ],  [    "title"=> "Retail Trade",    "percentage"=> 5.54,    "rank"=> 5,    "image"=> "http://localhost/img/industries/retail_trade.png",    "industryWage"=> "35957"  ],  [    "title"=> "Wages - No NAICS Code",    "percentage"=> 4.92,    "rank"=> 6,    "image"=> "http://localhost/img/industries/wages_-_no_naics_code.png",    "industryWage"=> "10342"  ],  [    "title"=> "Accommodation & Food Services",    "percentage"=> 4.41,    "rank"=> 7,    "image"=> "http://localhost/img/industries/accommodation_food_services.png",    "industryWage"=> "22722"  ],  [    "title"=> "Admin & Support & Waste Mgmt & Remediation",    "percentage"=> 4.1,    "rank"=> 8,    "image"=> "http://localhost/img/industries/admin_support_waste_mgmt_remediation.png",    "industryWage"=> "33461"  ],  [    "title"=> "Other Services",    "percentage"=> 4.1,    "rank"=> 9,    "image"=> "http://localhost/img/industries/other_services.png",    "industryWage"=> "29187"  ],  [    "title"=> "Finance & Insurance",    "percentage"=> 3.08,    "rank"=> 10,    "image"=> "http://localhost/img/industries/finance_insurance.png",    "industryWage"=> "51867"  ],  [    "title"=> "Professional, Scientific, & Technical Skills",    "percentage"=> 3.08,    "rank"=> 11,    "image"=> "http://localhost/img/industries/professional_scientific_technical_skills.png",    "industryWage"=> "46106"  ],  [    "title"=> "Wholesale Trade",    "percentage"=> 2.67,    "rank"=> 12,    "image"=> "http://localhost/img/industries/wholesale_trade.png",    "industryWage"=> "58381"  ],  [    "title"=> "Information",    "percentage"=> 2.46,    "rank"=> 13,    "image"=> "http://localhost/img/industries/information.png",    "industryWage"=> "28713"  ],  [    "title"=> "Manufacturing",    "percentage"=> 1.85,    "rank"=> 14,    "image"=> "http://localhost/img/industries/manufacturing.png",    "industryWage"=> "52236"  ],  [    "title"=> "Real Estate & Rental & Leasing",    "percentage"=> 1.74,    "rank"=> 15,    "image"=> "http://localhost/img/industries/real_estate_rental_leasing.png",    "industryWage"=> "47061"  ],  [    "title"=> "Construction",    "percentage"=> 1.64,    "rank"=> 16,    "image"=> "http://localhost/img/industries/construction.png",    "industryWage"=> "39117"  ],  [    "title"=> "Transportation & Warehousing",    "percentage"=> 1.44,    "rank"=> 17,    "image"=> "http://localhost/img/industries/transportation_warehousing.png",    "industryWage"=> "45455"  ],  [    "title"=> "No Wages",    "percentage"=> 0.1,    "rank"=> 18,    "image"=> "http://localhost/img/industries/no_wages.png",    "industryWage"=> null  ],  [    "title"=> "Agriculture, Forestry, Fishing, & Hunting",    "percentage"=> 0,    "rank"=> 19,    "image"=> "http://localhost/img/industries/agriculture_forestry_fishing_hunting.png",    "industryWage"=> null  ],  [    "title"=> "Non-Classified",    "percentage"=> 0,    "rank"=> 20,    "image"=> "http://localhost/img/industries/non-classified.png",    "industryWage"=> null  ],  [    "title"=> "Utilities",    "percentage"=> 0,    "rank"=> 21,    "image"=> "http://localhost/img/industries/utilities.png",    "industryWage"=> null  ],  [    "title"=> "Management of Companies & Enterprises",    "percentage"=> 0,    "rank"=> 22,    "image"=> "http://localhost/img/industries/management_of_companies_enterprises.png",    "industryWage"=> null  ]]);
          
        //   $this->assertEquals($aggregate_kinseology_wages,$aggregate_kinseology_live_wage_data);
        //   $this->assertEquals($aggregate_kinseology_images,$aggregate_kinseology_live_images_data);
    
        //   /** test if both accounting data are equal */
        //   $aggregate_kinseology_wages = json_decode($aggregate_kinseology_wages,true);
        //   $aggregate_kinseology_images = json_decode($aggregate_kinseology_images,true);
  
        //   foreach($aggregate_kinseology_wages as $iterate => $aggregate_kinseology_images)
        //   {
        //       $this->assertEquals($aggregate_kinseology_wages[$iterate]['rank'], $aggregate_kinseology_images['rank']);
        //       $this->assertEquals($aggregate_kinseology_wages[$iterate]['title'], $aggregate_kinseology_images['title']);
        //       $this->assertEquals($aggregate_kinseology_wages[$iterate]['industryWage'], $aggregate_kinseology_images['industryWage']);
        //   }


    }
}