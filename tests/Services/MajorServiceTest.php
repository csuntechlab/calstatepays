<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\FieldOfStudy;
use App\Models\HEGISCode;
use App\Models\University;
use App\Models\UniversityMajor;
use App\Services\MajorService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class MajorServiceTest extends TestCase
{
    use DatabaseMigrations;
    protected $majorService;

    public function setUp()
    {
        parent::setUp();
        $this->majorService = new MajorService();
        $this->seed('Hegis_Codes_TableSeeder');
        $this->seed('Naics_Titles_TableSeeder');
        $this->seed('Student_Paths_TableSeeder');
        //  $this->seed('Field_Of_Studies_TableSeeder');
        $this->seed('Hegis_Categories_TableSeeder');
        $this->seed('Major_Paths_TableSeeder');
        $this->seed('Major_Path_Wages_TableSeeder');
    }

    public function test_getAllHegisCodes_ensure_returns_all_rows()
    {
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Universities_TableSeeder');
        /**
         *  Should we test every univ id?
         */
        $univ_name = 'northridge';
        $response = $this->majorService->getAllHegisCodesByUniversity($univ_name);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey("hegis_code", $response[0]);
        $this->assertArrayHasKey("major", $response[0]);
        $this->assertArrayHasKey("university_id", $response[0]);

        /**
         *  example api call
         *  /major/hegis-codes/university/northridge
         *  Expect northridge to receive 86  
         */
        $count = University::where('short_name', $univ_name)
            ->with('universityMajors')
            ->get();
        $count = $count[0]->universityMajors->count();
        $this->assertEquals($count, count($response));
    }

    public function test_getAllHegisCodes_throws_a_model_not_found_exception()
    {
        $univ_id = 25;    
        // $message = ''.$univ_id.' was not found';
        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException');
        $this->majorService->getAllHegisCodesByUniversity($univ_id);
    }

    public function test_getAllFieldOfStudies_ensure_returns_all_rows()
    {
        $this->seed('Field_Of_Studies_TableSeeder');
        $response = $this->majorService->getAllFieldOfStudies();

        $this->assertArrayHasKey("name", $response[0]);
        $this->assertArrayHasKey("id", $response[0]);
        $this->assertEquals(FieldOfStudy::count(), count($response));
    }

    public function test_getAllFieldOfStudies_throws_a_model_not_found_exception()
    {
        $message = 'Field of Study table has no data';
        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException', $message, 409);
        $this->majorService->getAllFieldOfStudies();
    }

    public function test_getMajorEarnings_ensure_returns_all_major_path_wages()
    {
        $this->seed('Universities_TableSeeder');
        $this->seed('University_Majors_TableSeeder');
        $response = $this->majorService->getMajorEarnings(22021, 'northridge');
        $this->assertArrayHasKey("id", $response[0]);
        $this->assertArrayHasKey("student_path", $response[0]);
        $this->assertArrayHasKey("university_majors_id", $response[0]);
        $this->assertArrayHasKey("entry_status", $response[0]);
        $this->assertArrayHasKey("years", $response[0]);
        $this->assertArrayHasKey("major_path_wage", $response[0]);
    }

    public function test_getMajorEarnings_throws_a_model_not_found_exception()
    {
        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException');
        $response = $this->majorService->getMajorEarnings(22021, 'northridge');
    }

    public function test_getFREData_ensure_returns_all_keys()
    {
        $this->seed('Universities_TableSeeder');
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Master_FRE_Page_Data_TableSeeder');
        $request = new Request();
        $request->major = 22021;
        $request->university = 'northridge';
        $request->age_range = 2;
        $request->education_level = 'FTF';
        $request->annual_earnings = 3;
        $request->financial_aid = 2;
        
        //  dd($this->majorService->getFREData($request));
        $response = $this->majorService->getFREData($request);
        $this->arrayHasKey("student_background_id", $response);
        $this->arrayHasKey("annual_earnings_id", $response);
        $this->arrayHasKey("annual_financial_aid_id", $response);
        $this->arrayHasKey("time_to_degree", $response);
        $this->arrayHasKey("earnings_5_years", $response);
        $this->arrayHasKey("roi", $response);
    }

    public function test_getFREData_throws_a_model_not_found_exception()
    {
        $request = new Request();
        $request->major = 22021;
        $request->university = 'northridge';
        $request->age_range = 2;
        $request->education_level = 'FTF';
        $request->annual_earnings = 3;
        $request->financial_aid = 2;

        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException');
        $response = $this->majorService->getFREData($request);
    }


    public function test_getAllHegisCodesByUniversity_Opt_in_CSU()
    {
        $this->seed('Universities_TableSeeder');
        $this->seed('University_Majors_TableSeeder');
        // api route is
        // major/hegis-codes/university/{universityId}
        // i.e. major/hegis-codes/university/70
        $university_name = 'northridge';
        $northridge_majors = 86;

        $response = $this->majorService->getAllHegisCodesByUniversity($university_name);
        $this->assertArrayHasKey('major', $response[0]);
        $this->assertArrayHasKey('hegis_code', $response[0]);
        $this->assertArrayHasKey('university_id', $response[0]);
        $this->assertEquals(count($response), $northridge_majors);
    }

    public function test_getAllHegisCodesByUniversity_Opt_in_CSU_throws_a_model_not_found_exception()
    {
        $university_name = 'northridge';
        $message = '' . $university_name . ' was not found';
        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException');
        $response = $this->majorService->getAllHegisCodesByUniversity($university_name);
    }

    public function test_Aggregate_data_test_response_of_getMajorEarnings()
    {
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Universities_TableSeeder');
        $aggregate = 'all';
        $hegis = 11081;
        $response = $this->majorService->getMajorEarnings($hegis, $aggregate);
        $this->assertEquals($response[0]['entry_status'], "FTF + FTT");
        $this->assertArrayHasKey('major_path_wage', $response[0]);
    }

    public function test_Aggregate_getFREData_ensure_returns_all_keys()
    {
        $this->seed('Universities_TableSeeder');
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Master_FRE_Page_Data_TableSeeder');
        $request = new Request();
        $request->major = 22021;
        $request->university = 'all';
        $request->age_range = 1;
        $request->education_level = 'FTF';
        $request->annual_earnings = 1;
        $request->financial_aid = 1;

        $response = $this->majorService->getFREData($request);

        $this->arrayHasKey("student_background_id", $response);
        $this->arrayHasKey("annual_earnings_id", $response);
        $this->arrayHasKey("annual_financial_aid_id", $response);
        $this->arrayHasKey("time_to_degree", $response);
        $this->arrayHasKey("earnings_5_years", $response);
        $this->arrayHasKey("roi", $response);
    }

    public function test_Aggregate_return_major_count()
    {
        $this->seed('Universities_TableSeeder');
        $this->seed('University_Majors_TableSeeder');
        $university_name = 'all';
        $response = $this->majorService->getAllHegisCodesByUniversity($university_name);

        $expected_count = 164;
        $this->assertEquals($expected_count, count($response));
    }

    public function test_Able_to_retrieve_Aggregate_major_earnings()
    {
        $this->seed('Universities_TableSeeder');
        $this->seed('University_Majors_TableSeeder');
        $response = $this->majorService->getMajorEarnings(5021, 'all');

        // need 12 arrays response, year responses, 2,5,10,15
        // some college -> 4, bacc -> 4, post -> 4 ..
        // these tests make sure the relationships were made
        $this->assertEquals(12, count($response));
        $this->assertEquals(4, count($response[0]['major_path_wage']));

        $this->assertArrayHasKey("id", $response[0]);
        $this->assertArrayHasKey("student_path", $response[0]);
        $this->assertArrayHasKey("university_majors_id", $response[0]);
        $this->assertArrayHasKey("entry_status", $response[0]);
        $this->assertArrayHasKey("years", $response[0]);
        $this->assertArrayHasKey("major_path_wage", $response[0]);

    }

}