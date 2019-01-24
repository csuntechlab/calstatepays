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
        $this->seed('Hegis_Codes_TableSeeder');

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
            'university' => 'northridge'
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
            ->with($request->major, $request->university)
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
            ' major ' => 5021,
            ' university ' => ' northridge ',
        ];

        $request = new IndustryFormRequest($input);

        $data = json_encode([
            "someCollege" => [
                [
                    "title" => "No Wages",
                    "percentage" => 43.27,
                    "rank" => 1,
                    "student_path" => 2,
                    "industryWage" => null
                ],
            ],
            "bachelors" => [
                [
                    "title" => "Professional, Scientific, & Technical Skills",
                    "percentage" => 40.12,
                    "rank" => 1,
                    "student_path" => 1,
                    "industryWage" => 73073
                ]
            ],
            "post_bacc" => [
                [
                    "title" => "No Wages",
                    "percentage" => 65.96,
                    "rank" => 1,
                    "student_path" => 4,
                    "industryWage" => null
                ],
            ],
            "all" => [
                [
                    "title" => "Professional, Scientific, & Technical Skills",
                    "percentage" => 19.82,
                    "rank" => 1,
                    "student_path" => 1,
                    "industryWage" => 73073
                ],
            ]
        ]);

        $this->retriever
            ->shouldReceive('getIndustryPopulationByRank')
            ->once()
            ->with($request->hegis_code, $request->universityName)
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
        $response = $this->json('GET', '/api/industry/images/5021/northridge');

        $response->assertJsonStructure([

            "someCollege" => [
                0 => [
                    'title',
                    'percentage',
                    'rank',
                    'image'
                ]
            ],
            "post_bacc" => [
                0 => [
                    'title',
                    'percentage',
                    'rank',
                    'image'
                ]
            ],
            "bachelors" => [
                0 => [
                    'title',
                    'percentage',
                    'rank',
                    'image'
                ]
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

        $response = $this->json('GET', '/api/industry/5021/northridge');
        //  $response = $response->getOriginalContent();

        $response->assertStatus(200)
            ->assertJsonStructure(["someCollege" => ["0" => ["title", "percentage", "rank"]], "bachelors" => ["0" => ['title', 'percentage', 'rank']], "post_bacc" => ["0" => ['title', 'percentage', 'rank']]]);
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
            ->with($request->hegis, $request->university)
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
            ' hegis ' => 5021,
            ' university ' => ' all ',
        ];

        $request = new IndustryFormRequest($input);

        $firstResult = json_encode(["bachelors" => ["0" => ["title" => "Professional, Scientific, & Technical Skills", "percentage" => 40, "rank" => 1, "industryWage" => 69328]]]);

        $this->retriever
            ->shouldReceive('getIndustryPopulationByRank')
            ->once()
            ->with($request->hegis, $request->university)
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
        $fail = $this->json('GET', 'api/industry/43244/northridge');
        $this->assertEquals(400, $fail->status());

        /** test successful industry call */
        $industry = $this->json('GET', 'api/industry/5021/northridge');
        $industry->assertStatus(200);
        $industry = $industry->getOriginalContent();

        /** test the industry image call */
        $industryImage = $this->json('GET', 'api/industry/images/5021/northridge');
        $industryImage->assertStatus(200);
        $data = $industryImage->getOriginalContent();

        $this->industryWagesHelper($industry, $data);

          // Now make a industry api by calling other apis

          // call the universities
        $university_call = $this->json("GET", "api/university");
        $university_call = $university_call->getOriginalContent();


        /** test with northridge */
        $northridge = $university_call[5];
        $northridge_short_name = $northridge['short_name'];

        /** get hegis codes */
        $northridge_hegis = $this->json("GET", "api/major/hegis-codes/university/" . $northridge_short_name);
        $northridge_hegis = $northridge_hegis->getOriginalContent();
        $northridge_accounting_hegis = $northridge_hegis[0]['majorId'];

        /** call industry wages, and images in hegis code 5021 is accounting */
        $northridge_accounting_wages = $this->industryWagesAPIHelper($northridge_short_name, $northridge_accounting_hegis);
        $northridge_accounting_images = $this->industryImagesAPIHelper($northridge_short_name, $northridge_accounting_hegis);

        $northridge_accounting_wages_live_data = json_encode(["someCollege" => [["title" => "Finance & Insurance", "percentage" => 14.33, "rank" => 1, "student_path" => "2", "industryWage" => "44553"], ["title" => "Retail Trade", "percentage" => 13.89, "rank" => 2, "student_path" => "2", "industryWage" => "33784"], ["title" => "Professional, Scientific, & Technical Skills", "percentage" => 10.42, "rank" => 3, "student_path" => "2", "industryWage" => "47731"], ["title" => "Health Care & Social Assistance", "percentage" => 9.55, "rank" => 4, "student_path" => "2", "industryWage" => "35032"], ["title" => "Admin & Support & Waste Mgmt & Remediation", "percentage" => 7.53, "rank" => 5, "student_path" => "2", "industryWage" => "35683"], ["title" => "Accommodation & Food Services", "percentage" => 6.95, "rank" => 6, "student_path" => "2", "industryWage" => "27024"], ["title" => "Wholesale Trade", "percentage" => 5.93, "rank" => 7, "student_path" => "2", "industryWage" => "40389"], ["title" => "Wages - No NAICS Code", "percentage" => 5.79, "rank" => 8, "student_path" => "2", "industryWage" => "5234"], ["title" => "Information", "percentage" => 4.05, "rank" => 9, "student_path" => "2", "industryWage" => "60872"], ["title" => "Educational Services", "percentage" => 3.47, "rank" => 10, "student_path" => "2", "industryWage" => "30016"], ["title" => "Government", "percentage" => 3.47, "rank" => 11, "student_path" => "2", "industryWage" => "44733"], ["title" => "Real Estate & Rental & Leasing", "percentage" => 3.33, "rank" => 12, "student_path" => "2", "industryWage" => "45535"], ["title" => "Manufacturing", "percentage" => 3.33, "rank" => 13, "student_path" => "2", "industryWage" => "51389"], ["title" => "Construction", "percentage" => 3.18, "rank" => 14, "student_path" => "2", "industryWage" => "36804"], ["title" => "Transportation & Warehousing", "percentage" => 1.74, "rank" => 15, "student_path" => "2", "industryWage" => "32978"], ["title" => "Other Services", "percentage" => 1.59, "rank" => 16, "student_path" => "2", "industryWage" => "29317"], ["title" => "Utilities", "percentage" => 0.72, "rank" => 17, "student_path" => "2", "industryWage" => "78238"], ["title" => "Agriculture, Forestry, Fishing, & Hunting", "percentage" => 0.72, "rank" => 18, "student_path" => "2", "industryWage" => "34711"], ["title" => "Mining", "percentage" => 0, "rank" => 19, "student_path" => "2", "industryWage" => null], ["title" => "Management of Companies & Enterprises", "percentage" => 0, "rank" => 20, "student_path" => "2", "industryWage" => null], ["title" => "Arts, Entertainment, & Recreation", "percentage" => 0, "rank" => 21, "student_path" => "2", "industryWage" => null], ["title" => "Non-Classified", "percentage" => 0, "rank" => 22, "student_path" => "2", "industryWage" => null]], "bachelors" => [["title" => "Professional, Scientific, & Technical Skills", "percentage" => 40.15, "rank" => 1, "student_path" => "1", "industryWage" => "73073"], ["title" => "Finance & Insurance", "percentage" => 11.45, "rank" => 2, "student_path" => "1", "industryWage" => "71273"], ["title" => "Information", "percentage" => 5.93, "rank" => 3, "student_path" => "1", "industryWage" => "69891"], ["title" => "Admin & Support & Waste Mgmt & Remediation", "percentage" => 5.93, "rank" => 4, "student_path" => "1", "industryWage" => "56906"], ["title" => "Wages - No NAICS Code", "percentage" => 5.11, "rank" => 5, "student_path" => "1", "industryWage" => "61763"], ["title" => "Government", "percentage" => 4.91, "rank" => 6, "student_path" => "1", "industryWage" => "67599"], ["title" => "Manufacturing", "percentage" => 3.95, "rank" => 7, "student_path" => "1", "industryWage" => "64325"], ["title" => "Real Estate & Rental & Leasing", "percentage" => 3.75, "rank" => 8, "student_path" => "1", "industryWage" => "64247"], ["title" => "Health Care & Social Assistance", "percentage" => 3.27, "rank" => 9, "student_path" => "1", "industryWage" => "45465"], ["title" => "Retail Trade", "percentage" => 3.2, "rank" => 10, "student_path" => "1", "industryWage" => "50401"], ["title" => "Wholesale Trade", "percentage" => 2.73, "rank" => 11, "student_path" => "1", "industryWage" => "51746"], ["title" => "Educational Services", "percentage" => 2.39, "rank" => 12, "student_path" => "1", "industryWage" => "55619"], ["title" => "Other Services", "percentage" => 1.5, "rank" => 13, "student_path" => "1", "industryWage" => "59447"], ["title" => "Construction", "percentage" => 1.23, "rank" => 14, "student_path" => "1", "industryWage" => "71184"], ["title" => "Accommodation & Food Services", "percentage" => 1.23, "rank" => 15, "student_path" => "1", "industryWage" => "37452"], ["title" => "Transportation & Warehousing", "percentage" => 1.02, "rank" => 16, "student_path" => "1", "industryWage" => "73398"], ["title" => "Arts, Entertainment, & Recreation", "percentage" => 0.75, "rank" => 17, "student_path" => "1", "industryWage" => "46897"], ["title" => "Management of Companies & Enterprises", "percentage" => 0.61, "rank" => 18, "student_path" => "1", "industryWage" => "61578"], ["title" => "Utilities", "percentage" => 0.48, "rank" => 19, "student_path" => "1", "industryWage" => "101415"], ["title" => "Agriculture, Forestry, Fishing, & Hunting", "percentage" => 0.41, "rank" => 20, "student_path" => "1", "industryWage" => "45313"], ["title" => "Non-Classified", "percentage" => 0, "rank" => 21, "student_path" => "1", "industryWage" => null], ["title" => "Mining", "percentage" => 0, "rank" => 22, "student_path" => "1", "industryWage" => null]], "post_bacc" => [["title" => "Professional, Scientific, & Technical Skills", "percentage" => 36.08, "rank" => 1, "student_path" => "4", "industryWage" => "100220"], ["title" => "Manufacturing", "percentage" => 11.34, "rank" => 2, "student_path" => "4", "industryWage" => "102328"], ["title" => "Educational Services", "percentage" => 11.34, "rank" => 3, "student_path" => "4", "industryWage" => "67620"], ["title" => "Information", "percentage" => 9.28, "rank" => 4, "student_path" => "4", "industryWage" => "95904"], ["title" => "Government", "percentage" => 9.28, "rank" => 5, "student_path" => "4", "industryWage" => "96799"], ["title" => "Finance & Insurance", "percentage" => 8.25, "rank" => 6, "student_path" => "4", "industryWage" => "92816"], ["title" => "Admin & Support & Waste Mgmt & Remediation", "percentage" => 8.25, "rank" => 7, "student_path" => "4", "industryWage" => "113925"], ["title" => "Wages - No NAICS Code", "percentage" => 6.19, "rank" => 8, "student_path" => "4", "industryWage" => "25183"], ["title" => "Agriculture, Forestry, Fishing, & Hunting", "percentage" => 0, "rank" => 9, "student_path" => "4", "industryWage" => null], ["title" => "Utilities", "percentage" => 0, "rank" => 10, "student_path" => "4", "industryWage" => null], ["title" => "Wholesale Trade", "percentage" => 0, "rank" => 11, "student_path" => "4", "industryWage" => null], ["title" => "Retail Trade", "percentage" => 0, "rank" => 12, "student_path" => "4", "industryWage" => null], ["title" => "Real Estate & Rental & Leasing", "percentage" => 0, "rank" => 13, "student_path" => "4", "industryWage" => null], ["title" => "Management of Companies & Enterprises", "percentage" => 0, "rank" => 14, "student_path" => "4", "industryWage" => null], ["title" => "Health Care & Social Assistance", "percentage" => 0, "rank" => 15, "student_path" => "4", "industryWage" => null], ["title" => "Accommodation & Food Services", "percentage" => 0, "rank" => 16, "student_path" => "4", "industryWage" => null]]]);
        $northridge_accounting_wages_images_live_data = json_encode(["someCollege" => [["title" => "Finance & Insurance", "percentage" => 14.33, "rank" => 1, "image" => "http://localhost/img/industries/finance_insurance.png", "industryWage" => "44553"], ["title" => "Retail Trade", "percentage" => 13.89, "rank" => 2, "image" => "http://localhost/img/industries/retail_trade.png", "industryWage" => "33784"], ["title" => "Professional, Scientific, & Technical Skills", "percentage" => 10.42, "rank" => 3, "image" => "http://localhost/img/industries/professional_scientific_technical_skills.png", "industryWage" => "47731"], ["title" => "Health Care & Social Assistance", "percentage" => 9.55, "rank" => 4, "image" => "http://localhost/img/industries/health_care_social_assistance.png", "industryWage" => "35032"], ["title" => "Admin & Support & Waste Mgmt & Remediation", "percentage" => 7.53, "rank" => 5, "image" => "http://localhost/img/industries/admin_support_waste_mgmt_remediation.png", "industryWage" => "35683"], ["title" => "Accommodation & Food Services", "percentage" => 6.95, "rank" => 6, "image" => "http://localhost/img/industries/accommodation_food_services.png", "industryWage" => "27024"], ["title" => "Wholesale Trade", "percentage" => 5.93, "rank" => 7, "image" => "http://localhost/img/industries/wholesale_trade.png", "industryWage" => "40389"], ["title" => "Wages - No NAICS Code", "percentage" => 5.79, "rank" => 8, "image" => "http://localhost/img/industries/wages_-_no_naics_code.png", "industryWage" => "5234"], ["title" => "Information", "percentage" => 4.05, "rank" => 9, "image" => "http://localhost/img/industries/information.png", "industryWage" => "60872"], ["title" => "Educational Services", "percentage" => 3.47, "rank" => 10, "image" => "http://localhost/img/industries/educational_services.png", "industryWage" => "30016"], ["title" => "Government", "percentage" => 3.47, "rank" => 11, "image" => "http://localhost/img/industries/government.png", "industryWage" => "44733"], ["title" => "Real Estate & Rental & Leasing", "percentage" => 3.33, "rank" => 12, "image" => "http://localhost/img/industries/real_estate_rental_leasing.png", "industryWage" => "45535"], ["title" => "Manufacturing", "percentage" => 3.33, "rank" => 13, "image" => "http://localhost/img/industries/manufacturing.png", "industryWage" => "51389"], ["title" => "Construction", "percentage" => 3.18, "rank" => 14, "image" => "http://localhost/img/industries/construction.png", "industryWage" => "36804"], ["title" => "Transportation & Warehousing", "percentage" => 1.74, "rank" => 15, "image" => "http://localhost/img/industries/transportation_warehousing.png", "industryWage" => "32978"], ["title" => "Other Services", "percentage" => 1.59, "rank" => 16, "image" => "http://localhost/img/industries/other_services.png", "industryWage" => "29317"], ["title" => "Utilities", "percentage" => 0.72, "rank" => 17, "image" => "http://localhost/img/industries/utilities.png", "industryWage" => "78238"], ["title" => "Agriculture, Forestry, Fishing, & Hunting", "percentage" => 0.72, "rank" => 18, "image" => "http://localhost/img/industries/agriculture_forestry_fishing_hunting.png", "industryWage" => "34711"], ["title" => "Mining", "percentage" => 0, "rank" => 19, "image" => "http://localhost/img/industries/mining.png", "industryWage" => null], ["title" => "Management of Companies & Enterprises", "percentage" => 0, "rank" => 20, "image" => "http://localhost/img/industries/management_of_companies_enterprises.png", "industryWage" => null], ["title" => "Arts, Entertainment, & Recreation", "percentage" => 0, "rank" => 21, "image" => "http://localhost/img/industries/arts_entertainment_recreation.png", "industryWage" => null], ["title" => "Non-Classified", "percentage" => 0, "rank" => 22, "image" => "http://localhost/img/industries/non-classified.png", "industryWage" => null]], "bachelors" => [["title" => "Professional, Scientific, & Technical Skills", "percentage" => 40.15, "rank" => 1, "image" => "http://localhost/img/industries/professional_scientific_technical_skills.png", "industryWage" => "73073"], ["title" => "Finance & Insurance", "percentage" => 11.45, "rank" => 2, "image" => "http://localhost/img/industries/finance_insurance.png", "industryWage" => "71273"], ["title" => "Information", "percentage" => 5.93, "rank" => 3, "image" => "http://localhost/img/industries/information.png", "industryWage" => "69891"], ["title" => "Admin & Support & Waste Mgmt & Remediation", "percentage" => 5.93, "rank" => 4, "image" => "http://localhost/img/industries/admin_support_waste_mgmt_remediation.png", "industryWage" => "56906"], ["title" => "Wages - No NAICS Code", "percentage" => 5.11, "rank" => 5, "image" => "http://localhost/img/industries/wages_-_no_naics_code.png", "industryWage" => "61763"], ["title" => "Government", "percentage" => 4.91, "rank" => 6, "image" => "http://localhost/img/industries/government.png", "industryWage" => "67599"], ["title" => "Manufacturing", "percentage" => 3.95, "rank" => 7, "image" => "http://localhost/img/industries/manufacturing.png", "industryWage" => "64325"], ["title" => "Real Estate & Rental & Leasing", "percentage" => 3.75, "rank" => 8, "image" => "http://localhost/img/industries/real_estate_rental_leasing.png", "industryWage" => "64247"], ["title" => "Health Care & Social Assistance", "percentage" => 3.27, "rank" => 9, "image" => "http://localhost/img/industries/health_care_social_assistance.png", "industryWage" => "45465"], ["title" => "Retail Trade", "percentage" => 3.2, "rank" => 10, "image" => "http://localhost/img/industries/retail_trade.png", "industryWage" => "50401"], ["title" => "Wholesale Trade", "percentage" => 2.73, "rank" => 11, "image" => "http://localhost/img/industries/wholesale_trade.png", "industryWage" => "51746"], ["title" => "Educational Services", "percentage" => 2.39, "rank" => 12, "image" => "http://localhost/img/industries/educational_services.png", "industryWage" => "55619"], ["title" => "Other Services", "percentage" => 1.5, "rank" => 13, "image" => "http://localhost/img/industries/other_services.png", "industryWage" => "59447"], ["title" => "Construction", "percentage" => 1.23, "rank" => 14, "image" => "http://localhost/img/industries/construction.png", "industryWage" => "71184"], ["title" => "Accommodation & Food Services", "percentage" => 1.23, "rank" => 15, "image" => "http://localhost/img/industries/accommodation_food_services.png", "industryWage" => "37452"], ["title" => "Transportation & Warehousing", "percentage" => 1.02, "rank" => 16, "image" => "http://localhost/img/industries/transportation_warehousing.png", "industryWage" => "73398"], ["title" => "Arts, Entertainment, & Recreation", "percentage" => 0.75, "rank" => 17, "image" => "http://localhost/img/industries/arts_entertainment_recreation.png", "industryWage" => "46897"], ["title" => "Management of Companies & Enterprises", "percentage" => 0.61, "rank" => 18, "image" => "http://localhost/img/industries/management_of_companies_enterprises.png", "industryWage" => "61578"], ["title" => "Utilities", "percentage" => 0.48, "rank" => 19, "image" => "http://localhost/img/industries/utilities.png", "industryWage" => "101415"], ["title" => "Agriculture, Forestry, Fishing, & Hunting", "percentage" => 0.41, "rank" => 20, "image" => "http://localhost/img/industries/agriculture_forestry_fishing_hunting.png", "industryWage" => "45313"], ["title" => "Non-Classified", "percentage" => 0, "rank" => 21, "image" => "http://localhost/img/industries/non-classified.png", "industryWage" => null], ["title" => "Mining", "percentage" => 0, "rank" => 22, "image" => "http://localhost/img/industries/mining.png", "industryWage" => null]], "post_bacc" => [["title" => "Professional, Scientific, & Technical Skills", "percentage" => 36.08, "rank" => 1, "image" => "http://localhost/img/industries/professional_scientific_technical_skills.png", "industryWage" => "100220"], ["title" => "Manufacturing", "percentage" => 11.34, "rank" => 2, "image" => "http://localhost/img/industries/manufacturing.png", "industryWage" => "102328"], ["title" => "Educational Services", "percentage" => 11.34, "rank" => 3, "image" => "http://localhost/img/industries/educational_services.png", "industryWage" => "67620"], ["title" => "Information", "percentage" => 9.28, "rank" => 4, "image" => "http://localhost/img/industries/information.png", "industryWage" => "95904"], ["title" => "Government", "percentage" => 9.28, "rank" => 5, "image" => "http://localhost/img/industries/government.png", "industryWage" => "96799"], ["title" => "Finance & Insurance", "percentage" => 8.25, "rank" => 6, "image" => "http://localhost/img/industries/finance_insurance.png", "industryWage" => "92816"], ["title" => "Admin & Support & Waste Mgmt & Remediation", "percentage" => 8.25, "rank" => 7, "image" => "http://localhost/img/industries/admin_support_waste_mgmt_remediation.png", "industryWage" => "113925"], ["title" => "Wages - No NAICS Code", "percentage" => 6.19, "rank" => 8, "image" => "http://localhost/img/industries/wages_-_no_naics_code.png", "industryWage" => "25183"], ["title" => "Agriculture, Forestry, Fishing, & Hunting", "percentage" => 0, "rank" => 9, "image" => "http://localhost/img/industries/agriculture_forestry_fishing_hunting.png", "industryWage" => null], ["title" => "Utilities", "percentage" => 0, "rank" => 10, "image" => "http://localhost/img/industries/utilities.png", "industryWage" => null], ["title" => "Wholesale Trade", "percentage" => 0, "rank" => 11, "image" => "http://localhost/img/industries/wholesale_trade.png", "industryWage" => null], ["title" => "Retail Trade", "percentage" => 0, "rank" => 12, "image" => "http://localhost/img/industries/retail_trade.png", "industryWage" => null], ["title" => "Real Estate & Rental & Leasing", "percentage" => 0, "rank" => 13, "image" => "http://localhost/img/industries/real_estate_rental_leasing.png", "industryWage" => null], ["title" => "Management of Companies & Enterprises", "percentage" => 0, "rank" => 14, "image" => "http://localhost/img/industries/management_of_companies_enterprises.png", "industryWage" => null], ["title" => "Health Care & Social Assistance", "percentage" => 0, "rank" => 15, "image" => "http://localhost/img/industries/health_care_social_assistance.png", "industryWage" => null], ["title" => "Accommodation & Food Services", "percentage" => 0, "rank" => 16, "image" => "http://localhost/img/industries/accommodation_food_services.png", "industryWage" => null]]]);

        $this->assertEquals($northridge_accounting_wages, $northridge_accounting_wages_live_data);
        $this->assertEquals($northridge_accounting_images, $northridge_accounting_wages_images_live_data);

        /** test if both accounting data are equal */
        $northridge_accounting_wages = json_decode($northridge_accounting_wages, true);
        $northridge_accounting_images = json_decode($northridge_accounting_images, true);

        $this->industryWagesHelper($northridge_accounting_wages, $northridge_accounting_images);

        /** aggregate testing with 8351 Kinseology major  */
        $aggregate = $university_call[7];
        $aggregate_short_name = $northridge['short_name'];

        /** get hegis codes */
        $aggregate_hegis = $this->json("GET", "api/major/hegis-codes/university/" . $aggregate_short_name);
        $aggregate_hegis = $aggregate_hegis->getOriginalContent();
        $aggregate_kinseology_hegis = $aggregate_hegis[48]->majorId;

        /** call the industry api with aggregate short name and 8351 */
        $aggregate_kinseology_wages = $this->industryWagesAPIHelper($aggregate_short_name, $aggregate_kinseology_hegis);

        /** call the industry wage images, hegis code 8351, kinseology*/
        $aggregate_kinseology_images = $this->industryImagesAPIHelper($aggregate_short_name, $aggregate_kinseology_hegis);

        $aggregate_kinseology_live_wage_data = json_encode(["someCollege" => [["title" => "Health Care & Social Assistance", "percentage" => 16.32, "rank" => 1, "student_path" => "2", "industryWage" => "29881"], ["title" => "Retail Trade", "percentage" => 14.9, "rank" => 2, "student_path" => "2", "industryWage" => "25493"], ["title" => "Accommodation & Food Services", "percentage" => 10.3, "rank" => 3, "student_path" => "2", "industryWage" => "22543"], ["title" => "Educational Services", "percentage" => 8.56, "rank" => 4, "student_path" => "2", "industryWage" => "18099"], ["title" => "Admin & Support & Waste Mgmt & Remediation", "percentage" => 6.81, "rank" => 5, "student_path" => "2", "industryWage" => "27478"], ["title" => "Information", "percentage" => 5.86, "rank" => 6, "student_path" => "2", "industryWage" => "24916"], ["title" => "Finance & Insurance", "percentage" => 5.39, "rank" => 7, "student_path" => "2", "industryWage" => "42885"], ["title" => "Wages - No NAICS Code", "percentage" => 5.23, "rank" => 8, "student_path" => "2", "industryWage" => "8916"], ["title" => "Arts, Entertainment, & Recreation", "percentage" => 4.91, "rank" => 9, "student_path" => "2", "industryWage" => "20434"], ["title" => "Government", "percentage" => 4.12, "rank" => 10, "student_path" => "2", "industryWage" => "54147"], ["title" => "Professional, Scientific, & Technical Skills", "percentage" => 3.8, "rank" => 11, "student_path" => "2", "industryWage" => "34831"], ["title" => "Other Services", "percentage" => 3.65, "rank" => 12, "student_path" => "2", "industryWage" => "17318"], ["title" => "Construction", "percentage" => 2.38, "rank" => 13, "student_path" => "2", "industryWage" => "22861"], ["title" => "Transportation & Warehousing", "percentage" => 2.06, "rank" => 14, "student_path" => "2", "industryWage" => "29242"], ["title" => "Wholesale Trade", "percentage" => 2.06, "rank" => 15, "student_path" => "2", "industryWage" => "32413"], ["title" => "Manufacturing", "percentage" => 2.06, "rank" => 16, "student_path" => "2", "industryWage" => "42994"], ["title" => "Real Estate & Rental & Leasing", "percentage" => 1.58, "rank" => 17, "student_path" => "2", "industryWage" => "36902"], ["title" => "Management of Companies & Enterprises", "percentage" => 0, "rank" => 18, "student_path" => "2", "industryWage" => null], ["title" => "Utilities", "percentage" => 0, "rank" => 19, "student_path" => "2", "industryWage" => null], ["title" => "Non-Classified", "percentage" => 0, "rank" => 20, "student_path" => "2", "industryWage" => null], ["title" => "Agriculture, Forestry, Fishing, & Hunting", "percentage" => 0, "rank" => 21, "student_path" => "2", "industryWage" => null]], "bachelors" => [["title" => "Educational Services", "percentage" => 22.79, "rank" => 1, "student_path" => "1", "industryWage" => "51097"], ["title" => "Health Care & Social Assistance", "percentage" => 20.02, "rank" => 2, "student_path" => "1", "industryWage" => "34524"], ["title" => "Arts, Entertainment, & Recreation", "percentage" => 8.11, "rank" => 3, "student_path" => "1", "industryWage" => "30017"], ["title" => "Government", "percentage" => 8.01, "rank" => 4, "student_path" => "1", "industryWage" => "65825"], ["title" => "Retail Trade", "percentage" => 5.54, "rank" => 5, "student_path" => "1", "industryWage" => "35957"], ["title" => "Wages - No NAICS Code", "percentage" => 4.93, "rank" => 6, "student_path" => "1", "industryWage" => "10342"], ["title" => "Accommodation & Food Services", "percentage" => 4.41, "rank" => 7, "student_path" => "1", "industryWage" => "22722"], ["title" => "Admin & Support & Waste Mgmt & Remediation", "percentage" => 4.11, "rank" => 8, "student_path" => "1", "industryWage" => "33461"], ["title" => "Other Services", "percentage" => 4.11, "rank" => 9, "student_path" => "1", "industryWage" => "29187"], ["title" => "Professional, Scientific, & Technical Skills", "percentage" => 3.08, "rank" => 10, "student_path" => "1", "industryWage" => "46106"], ["title" => "Finance & Insurance", "percentage" => 3.08, "rank" => 11, "student_path" => "1", "industryWage" => "51867"], ["title" => "Wholesale Trade", "percentage" => 2.67, "rank" => 12, "student_path" => "1", "industryWage" => "58381"], ["title" => "Information", "percentage" => 2.46, "rank" => 13, "student_path" => "1", "industryWage" => "28713"], ["title" => "Manufacturing", "percentage" => 1.85, "rank" => 14, "student_path" => "1", "industryWage" => "52236"], ["title" => "Real Estate & Rental & Leasing", "percentage" => 1.75, "rank" => 15, "student_path" => "1", "industryWage" => "47061"], ["title" => "Construction", "percentage" => 1.64, "rank" => 16, "student_path" => "1", "industryWage" => "39117"], ["title" => "Transportation & Warehousing", "percentage" => 1.44, "rank" => 17, "student_path" => "1", "industryWage" => "45455"], ["title" => "Utilities", "percentage" => 0, "rank" => 18, "student_path" => "1", "industryWage" => null], ["title" => "Management of Companies & Enterprises", "percentage" => 0, "rank" => 19, "student_path" => "1", "industryWage" => null], ["title" => "Non-Classified", "percentage" => 0, "rank" => 20, "student_path" => "1", "industryWage" => null], ["title" => "Agriculture, Forestry, Fishing, & Hunting", "percentage" => 0, "rank" => 21, "student_path" => "1", "industryWage" => null]], "post_bacc" => [["title" => "Educational Services", "percentage" => 43.14, "rank" => 1, "student_path" => "4", "industryWage" => "73145"], ["title" => "Health Care & Social Assistance", "percentage" => 30.98, "rank" => 2, "student_path" => "4", "industryWage" => "74278"], ["title" => "Government", "percentage" => 6.67, "rank" => 3, "student_path" => "4", "industryWage" => "95206"], ["title" => "Wages - No NAICS Code", "percentage" => 5.49, "rank" => 4, "student_path" => "4", "industryWage" => "30624"], ["title" => "Admin & Support & Waste Mgmt & Remediation", "percentage" => 3.92, "rank" => 5, "student_path" => "4", "industryWage" => "57979"], ["title" => "Arts, Entertainment, & Recreation", "percentage" => 2.75, "rank" => 6, "student_path" => "4", "industryWage" => "30469"], ["title" => "Other Services", "percentage" => 2.75, "rank" => 7, "student_path" => "4", "industryWage" => "42189"], ["title" => "Professional, Scientific, & Technical Skills", "percentage" => 2.35, "rank" => 8, "student_path" => "4", "industryWage" => "48469"], ["title" => "Manufacturing", "percentage" => 1.96, "rank" => 9, "student_path" => "4", "industryWage" => "69515"], ["title" => "Wholesale Trade", "percentage" => 0, "rank" => 10, "student_path" => "4", "industryWage" => null], ["title" => "Information", "percentage" => 0, "rank" => 11, "student_path" => "4", "industryWage" => null], ["title" => "Finance & Insurance", "percentage" => 0, "rank" => 12, "student_path" => "4", "industryWage" => null], ["title" => "Real Estate & Rental & Leasing", "percentage" => 0, "rank" => 13, "student_path" => "4", "industryWage" => null], ["title" => "Accommodation & Food Services", "percentage" => 0, "rank" => 14, "student_path" => "4", "industryWage" => null]]]);
        $aggregate_kinseology_live_images_data = json_encode(["someCollege" => [["title" => "Health Care & Social Assistance", "percentage" => 16.32, "rank" => 1, "image" => "http://localhost/img/industries/health_care_social_assistance.png", "industryWage" => "29881"], ["title" => "Retail Trade", "percentage" => 14.9, "rank" => 2, "image" => "http://localhost/img/industries/retail_trade.png", "industryWage" => "25493"], ["title" => "Accommodation & Food Services", "percentage" => 10.3, "rank" => 3, "image" => "http://localhost/img/industries/accommodation_food_services.png", "industryWage" => "22543"], ["title" => "Educational Services", "percentage" => 8.56, "rank" => 4, "image" => "http://localhost/img/industries/educational_services.png", "industryWage" => "18099"], ["title" => "Admin & Support & Waste Mgmt & Remediation", "percentage" => 6.81, "rank" => 5, "image" => "http://localhost/img/industries/admin_support_waste_mgmt_remediation.png", "industryWage" => "27478"], ["title" => "Information", "percentage" => 5.86, "rank" => 6, "image" => "http://localhost/img/industries/information.png", "industryWage" => "24916"], ["title" => "Finance & Insurance", "percentage" => 5.39, "rank" => 7, "image" => "http://localhost/img/industries/finance_insurance.png", "industryWage" => "42885"], ["title" => "Wages - No NAICS Code", "percentage" => 5.23, "rank" => 8, "image" => "http://localhost/img/industries/wages_-_no_naics_code.png", "industryWage" => "8916"], ["title" => "Arts, Entertainment, & Recreation", "percentage" => 4.91, "rank" => 9, "image" => "http://localhost/img/industries/arts_entertainment_recreation.png", "industryWage" => "20434"], ["title" => "Government", "percentage" => 4.12, "rank" => 10, "image" => "http://localhost/img/industries/government.png", "industryWage" => "54147"], ["title" => "Professional, Scientific, & Technical Skills", "percentage" => 3.8, "rank" => 11, "image" => "http://localhost/img/industries/professional_scientific_technical_skills.png", "industryWage" => "34831"], ["title" => "Other Services", "percentage" => 3.65, "rank" => 12, "image" => "http://localhost/img/industries/other_services.png", "industryWage" => "17318"], ["title" => "Construction", "percentage" => 2.38, "rank" => 13, "image" => "http://localhost/img/industries/construction.png", "industryWage" => "22861"], ["title" => "Transportation & Warehousing", "percentage" => 2.06, "rank" => 14, "image" => "http://localhost/img/industries/transportation_warehousing.png", "industryWage" => "29242"], ["title" => "Wholesale Trade", "percentage" => 2.06, "rank" => 15, "image" => "http://localhost/img/industries/wholesale_trade.png", "industryWage" => "32413"], ["title" => "Manufacturing", "percentage" => 2.06, "rank" => 16, "image" => "http://localhost/img/industries/manufacturing.png", "industryWage" => "42994"], ["title" => "Real Estate & Rental & Leasing", "percentage" => 1.58, "rank" => 17, "image" => "http://localhost/img/industries/real_estate_rental_leasing.png", "industryWage" => "36902"], ["title" => "Management of Companies & Enterprises", "percentage" => 0, "rank" => 18, "image" => "http://localhost/img/industries/management_of_companies_enterprises.png", "industryWage" => null], ["title" => "Utilities", "percentage" => 0, "rank" => 19, "image" => "http://localhost/img/industries/utilities.png", "industryWage" => null], ["title" => "Non-Classified", "percentage" => 0, "rank" => 20, "image" => "http://localhost/img/industries/non-classified.png", "industryWage" => null], ["title" => "Agriculture, Forestry, Fishing, & Hunting", "percentage" => 0, "rank" => 21, "image" => "http://localhost/img/industries/agriculture_forestry_fishing_hunting.png", "industryWage" => null]], "bachelors" => [["title" => "Educational Services", "percentage" => 22.79, "rank" => 1, "image" => "http://localhost/img/industries/educational_services.png", "industryWage" => "51097"], ["title" => "Health Care & Social Assistance", "percentage" => 20.02, "rank" => 2, "image" => "http://localhost/img/industries/health_care_social_assistance.png", "industryWage" => "34524"], ["title" => "Arts, Entertainment, & Recreation", "percentage" => 8.11, "rank" => 3, "image" => "http://localhost/img/industries/arts_entertainment_recreation.png", "industryWage" => "30017"], ["title" => "Government", "percentage" => 8.01, "rank" => 4, "image" => "http://localhost/img/industries/government.png", "industryWage" => "65825"], ["title" => "Retail Trade", "percentage" => 5.54, "rank" => 5, "image" => "http://localhost/img/industries/retail_trade.png", "industryWage" => "35957"], ["title" => "Wages - No NAICS Code", "percentage" => 4.93, "rank" => 6, "image" => "http://localhost/img/industries/wages_-_no_naics_code.png", "industryWage" => "10342"], ["title" => "Accommodation & Food Services", "percentage" => 4.41, "rank" => 7, "image" => "http://localhost/img/industries/accommodation_food_services.png", "industryWage" => "22722"], ["title" => "Admin & Support & Waste Mgmt & Remediation", "percentage" => 4.11, "rank" => 8, "image" => "http://localhost/img/industries/admin_support_waste_mgmt_remediation.png", "industryWage" => "33461"], ["title" => "Other Services", "percentage" => 4.11, "rank" => 9, "image" => "http://localhost/img/industries/other_services.png", "industryWage" => "29187"], ["title" => "Professional, Scientific, & Technical Skills", "percentage" => 3.08, "rank" => 10, "image" => "http://localhost/img/industries/professional_scientific_technical_skills.png", "industryWage" => "46106"], ["title" => "Finance & Insurance", "percentage" => 3.08, "rank" => 11, "image" => "http://localhost/img/industries/finance_insurance.png", "industryWage" => "51867"], ["title" => "Wholesale Trade", "percentage" => 2.67, "rank" => 12, "image" => "http://localhost/img/industries/wholesale_trade.png", "industryWage" => "58381"], ["title" => "Information", "percentage" => 2.46, "rank" => 13, "image" => "http://localhost/img/industries/information.png", "industryWage" => "28713"], ["title" => "Manufacturing", "percentage" => 1.85, "rank" => 14, "image" => "http://localhost/img/industries/manufacturing.png", "industryWage" => "52236"], ["title" => "Real Estate & Rental & Leasing", "percentage" => 1.75, "rank" => 15, "image" => "http://localhost/img/industries/real_estate_rental_leasing.png", "industryWage" => "47061"], ["title" => "Construction", "percentage" => 1.64, "rank" => 16, "image" => "http://localhost/img/industries/construction.png", "industryWage" => "39117"], ["title" => "Transportation & Warehousing", "percentage" => 1.44, "rank" => 17, "image" => "http://localhost/img/industries/transportation_warehousing.png", "industryWage" => "45455"], ["title" => "Utilities", "percentage" => 0, "rank" => 18, "image" => "http://localhost/img/industries/utilities.png", "industryWage" => null], ["title" => "Management of Companies & Enterprises", "percentage" => 0, "rank" => 19, "image" => "http://localhost/img/industries/management_of_companies_enterprises.png", "industryWage" => null], ["title" => "Non-Classified", "percentage" => 0, "rank" => 20, "image" => "http://localhost/img/industries/non-classified.png", "industryWage" => null], ["title" => "Agriculture, Forestry, Fishing, & Hunting", "percentage" => 0, "rank" => 21, "image" => "http://localhost/img/industries/agriculture_forestry_fishing_hunting.png", "industryWage" => null]], "post_bacc" => [["title" => "Educational Services", "percentage" => 43.14, "rank" => 1, "image" => "http://localhost/img/industries/educational_services.png", "industryWage" => "73145"], ["title" => "Health Care & Social Assistance", "percentage" => 30.98, "rank" => 2, "image" => "http://localhost/img/industries/health_care_social_assistance.png", "industryWage" => "74278"], ["title" => "Government", "percentage" => 6.67, "rank" => 3, "image" => "http://localhost/img/industries/government.png", "industryWage" => "95206"], ["title" => "Wages - No NAICS Code", "percentage" => 5.49, "rank" => 4, "image" => "http://localhost/img/industries/wages_-_no_naics_code.png", "industryWage" => "30624"], ["title" => "Admin & Support & Waste Mgmt & Remediation", "percentage" => 3.92, "rank" => 5, "image" => "http://localhost/img/industries/admin_support_waste_mgmt_remediation.png", "industryWage" => "57979"], ["title" => "Arts, Entertainment, & Recreation", "percentage" => 2.75, "rank" => 6, "image" => "http://localhost/img/industries/arts_entertainment_recreation.png", "industryWage" => "30469"], ["title" => "Other Services", "percentage" => 2.75, "rank" => 7, "image" => "http://localhost/img/industries/other_services.png", "industryWage" => "42189"], ["title" => "Professional, Scientific, & Technical Skills", "percentage" => 2.35, "rank" => 8, "image" => "http://localhost/img/industries/professional_scientific_technical_skills.png", "industryWage" => "48469"], ["title" => "Manufacturing", "percentage" => 1.96, "rank" => 9, "image" => "http://localhost/img/industries/manufacturing.png", "industryWage" => "69515"], ["title" => "Wholesale Trade", "percentage" => 0, "rank" => 10, "image" => "http://localhost/img/industries/wholesale_trade.png", "industryWage" => null], ["title" => "Information", "percentage" => 0, "rank" => 11, "image" => "http://localhost/img/industries/information.png", "industryWage" => null], ["title" => "Finance & Insurance", "percentage" => 0, "rank" => 12, "image" => "http://localhost/img/industries/finance_insurance.png", "industryWage" => null], ["title" => "Real Estate & Rental & Leasing", "percentage" => 0, "rank" => 13, "image" => "http://localhost/img/industries/real_estate_rental_leasing.png", "industryWage" => null], ["title" => "Accommodation & Food Services", "percentage" => 0, "rank" => 14, "image" => "http://localhost/img/industries/accommodation_food_services.png", "industryWage" => null]]]);

        $this->assertEquals($aggregate_kinseology_wages, $aggregate_kinseology_live_wage_data);
        $this->assertEquals($aggregate_kinseology_images, $aggregate_kinseology_live_images_data);

        /** test if both accounting data are equal */
        $aggregate_kinseology_wages = json_decode($aggregate_kinseology_wages, true);
        $aggregate_kinseology_images = json_decode($aggregate_kinseology_images, true);

        $this->industryWagesHelper($aggregate_kinseology_wages, $aggregate_kinseology_images);
    }

    private function industryWagesHelper($data, $industry)
    {
        /** make sure that image data == industry data */
        foreach ($data['someCollege'] as $iterate => $industry) {
            $this->assertEquals($data['someCollege'][$iterate]['rank'], $industry['rank']);
            $this->assertEquals($data['someCollege'][$iterate]['title'], $industry['title']);
            $this->assertEquals($data['someCollege'][$iterate]['industryWage'], $industry['industryWage']);
        }
        foreach ($data['bachelors'] as $iterate => $industry) {
            $this->assertEquals($data['bachelors'][$iterate]['rank'], $industry['rank']);
            $this->assertEquals($data['bachelors'][$iterate]['title'], $industry['title']);
            $this->assertEquals($data['bachelors'][$iterate]['industryWage'], $industry['industryWage']);
        }
        foreach ($data['post_bacc'] as $iterate => $industry) {
            $this->assertEquals($data['post_bacc'][$iterate]['rank'], $industry['rank']);
            $this->assertEquals($data['post_bacc'][$iterate]['title'], $industry['title']);
            $this->assertEquals($data['post_bacc'][$iterate]['industryWage'], $industry['industryWage']);
        }
    }
    
    // goes through all steps to get the api call
    // used for the industry controller test
    private function industryWagesAPIHelper($university_short_name, $hegis)
    {
        $hegis_wages = $this->json("GET", "api/industry/" . $hegis . "/" . $university_short_name);
        $hegis_wages = $hegis_wages->getOriginalContent();
        $hegis_wages = json_encode($hegis_wages);
        return $hegis_wages;
    }

    // calls the api for images 
    // used for the industry controller test
    private function industryImagesAPIHelper($university_short_name, $hegis)
    {
        $hegis_image = $this->json("GET", "api/industry/images/" . $hegis . "/" . $university_short_name);
        $hegis_image = $hegis_image->getOriginalContent();
        $hegis_image = json_encode($hegis_image);
        return $hegis_image;
    }
}