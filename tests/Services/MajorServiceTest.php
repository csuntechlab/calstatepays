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

     public function setUp(){
         parent::setUp();
         $this->majorService = new MajorService();
     }

     public function test_getAllHegisCodes_ensure_returns_all_rows() 
     {
          $this->seed('University_Majors_TableSeeder');
          $this->seed('Universities_TableSeeder');
         /**
          *  Should we test every univ id?
          */
         $univ_id = 70;
         $response = $this->majorService->getAllHegisCodesByUniversity($univ_id);
         $this->assertArrayHasKey(0, $response);
         $this->assertArrayHasKey("hegis_code", $response[0]);
         $this->assertArrayHasKey("major", $response[0]);
         $this->assertArrayHasKey("university_id", $response[0]);

         // there are a lot more HEGIS codes due to other schools
         // csun only has 86 unique
         $this->assertEquals(UniversityMajor::where('university_id', $univ_id)->get()->count(), count($response));
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
         
        $message ='Field of Study table has no data';
        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException', $message,409);
        $this->majorService->getAllFieldOfStudies();
     }

     public function test_getMajorEarnings_ensure_returns_all_major_path_wages()
     {
         $this->seed('University_Majors_TableSeeder');
         $this->seed('Universities_TableSeeder');
         $this->seed('Major_Paths_TableSeeder');
         $this->seed('Major_Path_Wages_TableSeeder');
         $response = $this->majorService->getMajorEarnings(22021, 70);
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
         $response = $this->majorService->getMajorEarnings(22021, 70);
     }

     public function test_getFREData_ensure_returns_all_keys()
     {
         $this->seed('University_Majors_TableSeeder');
         $this->seed('Universities_TableSeeder');
         $this->seed('Major_Paths_TableSeeder');
         $this->seed('Major_Path_Wages_TableSeeder');
         $this->seed('Master_FRE_Page_Data_TableSeeder');
         $request = new Request();
         $request->major = 22021;
         $request->university = 70;
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
         $request->university = 70;
         $request->age_range = 2;
         $request->education_level = 'FTF';
         $request->annual_earnings = 3;
         $request->financial_aid = 2;
         
         $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException');
         $response = $this->majorService->getFREData($request);
     }


    public function test_getAllHegisCodesByUniversity_Opt_in_CSU()
    {
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Universities_TableSeeder');
        $this->seed('Major_Paths_TableSeeder');
        $this->seed('Major_Path_Wages_TableSeeder');
        // api route is
        // major/hegis-codes/university/{universityId}
        // i.e. major/hegis-codes/university/70
        $university_id = 70;
        $northridge_majors = 86;

        $response = $this->majorService->getAllHegisCodesByUniversity($university_id);
        $this->assertArrayHasKey('major',$response[0]);
        $this->assertArrayHasKey('hegis_code',$response[0]);
        $this->assertArrayHasKey('university_id',$response[0]);
        $this->assertEquals(count($response),$northridge_majors);
    }

    public function test_getAllHegisCodesByUniversity_Opt_in_CSU_throws_a_model_not_found_exception()
    {
        $university_id = 70;
        $message = ''.$university_id.' was not found';
        $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException');
        $response = $this->majorService->getAllHegisCodesByUniversity($university_id);
    }

}