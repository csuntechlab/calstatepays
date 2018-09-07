<?php

namespace Tests\Feature;

use App\Http\Controllers\MajorController;
use App\Contracts\MajorContract;
use App\Models\StudentPath;
use App\Models\UniversityMajor;
use App\Models\MajorPath;
use App\Models\MajorPathWage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;

class MajorControllerTest extends TestCase
{
//     use DatabaseMigrations;

//     private $controller;
//     private $retriever;
//     private $validMajorId = 22021;
//     private $validUniversity = 70;

//     public function setUp(){
//         parent::setUp();
//         $this->retriever = Mockery::mock(MajorContract::class);
//         $this->seed('Hegis_Codes_TableSeeder');
//         $this->seed('University_Majors_TableSeeder');
//         $this->seed('Naics_Titles_TableSeeder');
//         $this->seed('Student_Paths_TableSeeder');
//         $this->seed('Field_Of_Studies_TableSeeder');
//         $this->seed('Hegis_Categories_TableSeeder');
//         $this->seed('Universities_TableSeeder');
//         $this->seed('Major_Paths_TableSeeder');
//         $this->seed('Major_Path_Wages_TableSeeder');
        
//         // $this->seed('Master_Major_Page_Data_TableSeeder');
//         $this->seed('Master_FRE_Page_Data_TableSeeder');
//         $this->seed('Master_Industry_Page_Data_Seeder');

//         $this->controller = new MajorController($this->retriever);
//     }

//     public function test_getAllHegisCodes_ReturnsSuccessJsonFormat()
//     {
//         $test = [
//             [
//                 'hegis_code' => 100,
//                 'major' => 4,
//                 'university' => 1001
//             ],
//             [
//             'hegis_code' => 111,
//             'major' => 3,
//             'university' => 1032
//             ]
//         ];

//         $this->retriever
//             ->shouldReceive('getAllHegisCodes')
//             ->once()->andReturn($test);
  
//         $response = $this->retriever->getAllHegisCodes(); 
        
//         $this->assertEquals($test, $response);
//     }

//     public function test_getAllFieldOfStudies_returns_json_format()
//     {
//         $test = [
//             [
//                 'id' => 0,
//                 'name' => 'Natural Sciences'
//             ]
//         ];

//         $this->retriever
//             ->shouldReceive('getAllFieldOfStudies')
//             ->once()->andReturn($test);
        
//         $response = $this->retriever->getAllFieldOfStudies();
//         $this->assertEquals($test, $response);
//     }

//     public function test_getMajorEarnings_returns_data_for_3_paths()
//     {
//         $response = $this->get('/api/major/'.$this->validMajorId.'/'.$this->validUniversity);
//         $response->assertStatus(200);
//         $response->assertJsonStructure([
//             'majorId',
//             'universityId',
//             'someCollege',
//             'bachelors',
//             'postBacc'
//         ]);
//     }

//     public function test_extractWageByYearKey_returns_single_array_with_2_5_10_keys()
//     {
//         $testData = [
//             'years' => 10,
//             'major_path_wage' => [
//                 'avg_wage' => 50000,
//                 '25th'     => 30000,
//                 '50th'     => 45000,
//                 '75th'     => 60000
//             ]
//         ];
//         $returnedArray = $this->controller->extractWageByYearKey($testData);
//         $this->assertEquals([
//                 'avg_wage' => 50000,
//                 '25th'     => 30000,
//                 '50th'     => 45000,
//                 '75th'     => 60000], $returnedArray);
//     }

//     //FRE - Financial Return On Investment, this function populates FRE page bar charts
//     public function test_getFREData_returns_time_to_degree_and_estimated_5_year_earnings_and_roi()
//     {
//         $major = 5011;
//         $university = 70;
//         $age_range = 1;
//         $education_level = 'FTT';
//         $annual_earnings = 2;
//         $financial_aid = 3;
//         $response = $this->json('GET', "/api/major/$major/$university/$age_range/$education_level/$annual_earnings/$financial_aid");
//         $response->assertJsonStructure([
//             'majorId',
//             'universityId',
//             'fre' => [
//                 'timeToDegree',
//                 'earningsYearFive',
//                 'returnOnInvestment'
//             ]
//         ]);
//     }

//     public function test_filterByFieldOfStudy_returns_all_related_hegis_codes_in_json_format()
//     {
//         $engineeringId = 6;
//         $countOfRelatedHegisCOdes = 14;
//         $response = $this->json('GET', "/api/major/hegis-codes/$engineeringId");
//         $response = $response->getOriginalContent();
//         $this->assertCount($countOfRelatedHegisCOdes, $response[0]);
//     }
}
