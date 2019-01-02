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
use App\Http\Requests\MajorFormRequest;
use Illuminate\Support\Facades\Validator;

class MajorControllerTest extends TestCase
{
    use DatabaseMigrations;

    private $controller;
    private $retriever;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::mock(MajorContract::class);
        $this->seed('Hegis_Codes_TableSeeder');
        $this->seed('Naics_Titles_TableSeeder');
        $this->seed('Field_Of_Studies_TableSeeder');
        $this->seed('Hegis_Categories_TableSeeder');
        $this->seed('Universities_TableSeeder');

        $this->seed('Aggregate_Major_Path_TableSeeder');
        $this->seed('Aggregate_Major_Path_Wages_TableSeeder');
        $this->seed('Aggregate_University_Majors_TableSeeder');

        $this->seed('Northridge_Major_Path_TableSeeder');
        $this->seed('Northridge_Major_Path_Wages_TableSeeder');
        $this->seed('Northridge_University_Majors_TableSeeder');

        $this->controller = new MajorController($this->retriever);
    }

    /**
     * Api route : api/major/hegis-codes/university/{university_name}
     * method : MajorController@getAllHegisCodes
     * test uses dependency injection 
     */
    public function test_getAllHegisCodesByUniversity_ReturnsSuccessJsonFormat()
    {
        $universityName = "northridge";
        $test = [
            [
                'hegis_code' => 100,
                'major' => 4,
                'university' => 1001
            ],
            [
                'hegis_code' => 111,
                'major' => 3,
                'university' => 1032
            ]
        ];

        $this->retriever
            ->shouldReceive('getAllHegisCodesByUniversity')
            ->with($universityName)
            ->once()->andReturn($test);

        $response = $this->retriever->getAllHegisCodesByUniversity($universityName);

        $this->assertEquals($test, $response);
    }

    /**
     * Api route : api/major/field-of-study
     * method : MajorController@getAllFieldOfStudies
     * test uses dependency injection 
     */
    public function test_getAllFieldOfStudies_returns_json_format()
    {
        $test = [
            [
                'id' => 0,
                'name' => 'Natural Sciences'
            ]
        ];

        $this->retriever
            ->shouldReceive('getAllFieldOfStudies')
            ->once()->andReturn($test);

        $response = $this->retriever->getAllFieldOfStudies();
        $this->assertEquals($test, $response);
    }

    /**
     * Api route : api/major/hegis-codes/{universityName}/{fieldOfStudyId}
     * ie : /api/major/hegis-code/northridge/6
     * method : MajorController@filterByFieldOfStudy
     * test uses dependency injection 
     */
    public function test_filterByFieldOfStudy_Success_Contract_Call()
    {
        $hegisId = 6;
        $universityName = "northridge";

        $contractResponse =
            [["hegis_code" => 7012, "hegis_category_id" => 7, "university_majors" => ["id" => 24, "hegis_code" => 7012, "university_id" => 70, "major" => "Computer Science and Information Technology"]]];

        $test =
            [[["major" => "Computer Science and Information Technology", "hegisCode" => 7012, "hegis_category_id" => 7]]];


        $this->retriever
            ->shouldReceive('getHegisCategories')
            ->with($universityName, $hegisId)
            ->once()->andReturn($contractResponse);

        $response = $this->controller->filterByFieldOfStudy($universityName, $hegisId);
        $this->assertEquals($test, $response);
    }

    /**
     * Api route : api/major/{major}/{university}
     * method : MajorController@getMajorEarnings
     * test assert status
     */
    public function test_getMajorEarnings_returns_data_for_3_paths()
    {
        $this->seed('Investments_Template_Northridge_TableSeeder');
        $this->seed('Student_Backgrounds_Template_Northridge_TableSeeder');

        $major = 4011;
        $universityName = 'northridge';
        $response = $this->get('/api/major/' . $major . '/' . $universityName);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'majorId',
            'universityName',
            'someCollege',
            'bachelors',
            'postBacc'
        ]);
    }

    public function test_extractWageByYearKey_returns_single_array_with_2_5_10_keys()
    {
        $testData = [
            'years' => 10,
            'major_path_wage' => [
                'avg_wage' => 50000,
                '25th' => 30000,
                '50th' => 45000,
                '75th' => 60000
            ]
        ];
        $returnedArray = $this->controller->extractWageByYearKey($testData);
        $this->assertEquals([
            'avg_wage' => 50000,
            '25th' => 30000,
            '50th' => 45000,
            '75th' => 60000
        ], $returnedArray);
    }

    /**
     * Api route : api/major/hegis-codes/{universityName}/{fieldOfStudyId}
     * method : MajorController@filterByFieldOfStudy
     * i.e. /api/major/hegis-code/northridge/6
     * Assert json structure 
     */
    public function test_filterByFieldOfStudy_returns_all_related_hegis_codes_in_json_format()
    {
        $engineeringId = 6;
        $universityName = 'northridge';
        $countOfExpectedDropdowns = 9;
        $response = $this->json('GET', "/api/major/hegis-codes/" . $universityName . "/" . $engineeringId);

         //use [0] because front end is handling an array of an array of arrays
        $response = $response->getOriginalContent();
        $count = count($response[0]);
        $this->assertEquals($countOfExpectedDropdowns, $count);
    }

    /**
     * Test the getMajorEarnings for aggregate specifically
     * test for equality with test API and live data response
     * api is /api/major/5021/all
     */
     public function test_Aggregate_major_earnings()
     { 
         $major = 5021;
         $university = 'all';

        $response = $this->json('GET', "/api/major/".$major."/".$university );
        $response = $response->getContent();

        $liveDataResponse = json_encode(["majorId"=>"5021","universityName"=>"all","someCollege"=>["2"=>["major_path_id"=>"4701","_25th"=>"13407","_50th"=>"27092","_75th"=>"43035"],"5"=>["major_path_id"=>"4702","_25th"=>"20223","_50th"=>"36331","_75th"=>"54250"],"10"=>["major_path_id"=>"4703","_25th"=>"24714","_50th"=>"45893","_75th"=>"66545"],"15"=>["major_path_id"=>"4704","_25th"=>"28853","_50th"=>"50920","_75th"=>"79130"]],"bachelors"=>["2"=>["major_path_id"=>"4061","_25th"=>"37054","_50th"=>"52538","_75th"=>"61637"],"5"=>["major_path_id"=>"4062","_25th"=>"46624","_50th"=>"65392","_75th"=>"80988"],"10"=>["major_path_id"=>"4063","_25th"=>"54709","_50th"=>"80466","_75th"=>"104968"],"15"=>["major_path_id"=>"4064","_25th"=>"65692","_50th"=>"96147","_75th"=>"134611"]],"postBacc"=>["2"=>["major_path_id"=>"5349","_25th"=>"60201","_50th"=>"78283","_75th"=>"103432"],"5"=>["major_path_id"=>"5350","_25th"=>"62388","_50th"=>"92151","_75th"=>"120479"],"10"=>["major_path_id"=>"5351","_25th"=>"71176","_50th"=>"94040","_75th"=>"135539"],"15"=>["major_path_id"=>"5352","_25th"=>null,"_50th"=>null,"_75th"=>null]]]);

         $this->assertEquals($liveDataResponse,$response);
     }

    /**
     *  Test specifically for aggregate
     *  Testing structure for aggregate API
     *  major/hegis-codes/university/{university_name}
     *  major/hegis-codes/university/all
     */
    public function test_Aggregate_api_for_earnings()
    {
        $universityName = 'all';

        $structure = [
            [
                "major" => "Accounting",
                "hegis_code" => 5021,
                "university_id" => 0
            ]
        ];

        $this->retriever
            ->shouldReceive('getAllHegisCodesByUniversity')
            ->once()
            ->with($universityName)
            ->andReturn($structure);

        $response = $this->controller->getAllHegisCodesByUniversity($universityName);
        $this->assertEquals($response, $structure);
    }

    /** 
     *  test getAllFieldOfStudies assert count 
     *  api/major/field-of-study
     *  assert JSON structure
    */
    public function test_field_Of_Study_Api()
    {
        $fieldOfStudies = $this->json('GET', 'api/major/field-of-study');
        $fieldOfStudies->assertStatus(200);
        $fieldOfStudies = $fieldOfStudies->getOriginalContent();

        foreach ($fieldOfStudies as $iterate => $success) {
            $this->assertArrayHasKey('id', $success);
            $this->assertArrayHasKey('discipline', $success);
            $this->assertNotNull('id', $success);
            $this->assertNotNull('discipline', $success);
        }

        $count = count($fieldOfStudies);
        $this->assertEquals(8, $count);
    }

    private function getAllHegisCodesByUniversity_helper($universityName, $expectedCount)
    {
        $getAllHegisCodesBy = $this->json('GET', 'api/major/hegis-codes/university/' . $universityName);
        $getAllHegisCodesBy->assertStatus(200);
        $getAllHegisCodesBy = $getAllHegisCodesBy->getOriginalContent();

        foreach ($getAllHegisCodesBy as $iterate => $success) {
            $this->assertArrayHasKey('major', $success);
            $this->assertArrayHasKey('majorId', $success);
            $this->assertArrayHasKey('university_id', $success);
            $this->assertNotNull('major', $success);
            $this->assertNotNull('majorId', $success);
            $this->assertNotNull('university_id', $success);
        }

        $count = count($getAllHegisCodesBy);
        $this->assertEquals($expectedCount, $count);
    }

    private function filterByFieldOfStudyUniversity_helper($universityName, $fieldOfStudy, $expectedCount)
    {
        $filterByFieldOfStudy = $this->json('GET', 'api/major/hegis-codes/' . $universityName . '/' . $fieldOfStudy);
        $filterByFieldOfStudy->assertStatus(200);
        $filterByFieldOfStudy = $filterByFieldOfStudy->getOriginalContent();

        foreach ($filterByFieldOfStudy[0] as $iterate => $success) {
            $this->assertArrayHasKey('major', $success);
            $this->assertArrayHasKey('hegisCode', $success);
            $this->assertArrayHasKey('hegis_category_id', $success);
            $this->assertNotNull('major', $success);
            $this->assertNotNull('hegisCode', $success);
            $this->assertNotNull('hegis_category_id', $success);
        }

        $count = count($filterByFieldOfStudy[0]);
        $this->assertEquals($expectedCount, $count);
    }

    private function getMajorEarnings_helper($universityName, $major)
    {
        $getMajorEarnings = $this->json('GET', 'api/major/' . $major . '/' . $universityName);
        $getMajorEarnings->assertStatus(200);
        $getMajorEarnings = $getMajorEarnings->getOriginalContent();

        $this->assertArrayHasKey('majorId', $getMajorEarnings);
        $this->assertArrayHasKey('universityName', $getMajorEarnings);
        $this->assertArrayHasKey('someCollege', $getMajorEarnings);
        $this->assertArrayHasKey('bachelors', $getMajorEarnings);
        $this->assertArrayHasKey('postBacc', $getMajorEarnings);

        $this->assertNotNull('majorId', $getMajorEarnings);
        $this->assertNotNull('universityName', $getMajorEarnings);
        $this->assertNotNull('someCollege', $getMajorEarnings);
        $this->assertNotNull('bachelors', $getMajorEarnings);
        $this->assertNotNull('postBacc', $getMajorEarnings);

        $count = count($getMajorEarnings);
        $this->assertEquals(5, $count);

        $this->studentPath_helper($getMajorEarnings, 'someCollege');
        $this->studentPath_helper($getMajorEarnings, 'bachelors');
        $this->studentPath_helper($getMajorEarnings, 'postBacc');
    }

    private function studentPath_helper($getMajorEarnings, $studentPath)
    {
        foreach ($getMajorEarnings[$studentPath] as $iterate => $success) {
            $this->assertArrayHasKey('major_path_id', $success);
            $this->assertArrayHasKey('_25th', $success);
            $this->assertArrayHasKey('_50th', $success);
            $this->assertArrayHasKey('_75th', $success);
            $this->assertNotNull('major_path_id', $success);

        }
    }


    public function test_Major_Test_Controller()
    {
        /** test get getAllHegisCodesBy northridge assert count per-university */
        $universityName = "northridge";
        $expectedCount = 84;
        $this->getAllHegisCodesByUniversity_helper($universityName, $expectedCount);

        /** test get getAllHegisCodesBy aggregate assert count per-university */
        $universityName = "all";
        $expectedCount = 164;
        $this->getAllHegisCodesByUniversity_helper($universityName, $expectedCount);

        /** test filterByFieldOfStudy northridge assert count */
        $universityName = "northridge";
        $fieldOfStudy = 6;
        $expectedCount = 9;
        $this->filterByFieldOfStudyUniversity_helper($universityName, $fieldOfStudy, $expectedCount);

        /** test filterByFieldOfStudy aggregate assert count */
        $universityName = "all";
        $fieldOfStudy = 6;
        $expectedCount = 26;
        $this->filterByFieldOfStudyUniversity_helper($universityName, $fieldOfStudy, $expectedCount);

        /** test northridge getMajorEarnings assert count */
        $major = 5021;
        $universityName = "northridge";

        /** test aggregate getMajorEarnings assert count */
        $major = 5021;
        $universityName = "all";
        $universityName = "northridge";

        $this->getMajorEarnings_helper($universityName, $major);

        /** Exception testing */
        $universityName = "channelIslands";

        /** test get getAllHegisCodesBy northridge throws an error code*/
        $getAllHegisCodesByUniversityFail = $this->json('GET', 'api/major/hegis-codes/university/' . $universityName);

        $code = $getAllHegisCodesByUniversityFail->original['code'];
        $this->assertFalse($getAllHegisCodesByUniversityFail->original['success']);
        $this->assertEquals(409, $code);

        /** test filterByFieldOfStudy  throws an error code*/
        $fieldOfStudy = 21;

        $filterByFieldOfStudyFail = $this->json('GET', 'api/major/hegis-codes/' . $universityName . '/' . $fieldOfStudy);

        $code = $filterByFieldOfStudyFail->original['code'];
        $this->assertFalse($filterByFieldOfStudyFail->original['success']);
        $this->assertEquals(409, $code);

        /** test  getMajorEarnings throws an error code*/
        $major = 21091;

        $getMajorEarningsFail = $this->json('GET', 'api/major/' . $major . '/' . $universityName);

        $code = $getMajorEarningsFail->original['code'];
        $this->assertFalse($getMajorEarningsFail->original['success']);
        $this->assertEquals(409, $code);
    }
}
