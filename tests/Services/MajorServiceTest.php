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
        $this->seed('Hegis_Codes_TableSeeder');
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Naics_Titles_TableSeeder');
        $this->seed('Student_Paths_TableSeeder');
        $this->seed('Field_Of_Studies_TableSeeder');
        $this->seed('Hegis_Categories_TableSeeder');
        $this->seed('Universities_TableSeeder');
        $this->seed('Master_Major_Page_Data_TableSeeder');
    }

    public function test_getAllHegisCodes_ensure_returns_all_rows() {
        $response = $this->majorService->getAllHegisCodes();

        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey("hegis_code", $response[0]);
        $this->assertArrayHasKey("major", $response[0]);
        $this->assertArrayHasKey("university", $response[0]);
        $this->assertEquals(HEGISCode::count(), count($response));
    }

    public function test_getAllFieldOfStudies_ensure_returns_all_rows() {
        $this->seed('Field_Of_Studies_TableSeeder');
        $response = $this->majorService->getAllFieldOfStudies();

        $this->assertArrayHasKey("name", $response[0]);        
        $this->assertArrayHasKey("id", $response[0]);
        $this->assertEquals(FieldOfStudy::count(), count($response));
    }

    public function test_getMajorEarnings_ensure_returns_all_major_path_wages(){
        $response = $this->majorService->getMajorEarnings(22021, 70);
        $this->assertArrayHasKey("id", $response[0]);        
        $this->assertArrayHasKey("student_path", $response[0]);    
        $this->assertArrayHasKey("university_majors_id", $response[0]);        
        $this->assertArrayHasKey("entry_status", $response[0]);
        $this->assertArrayHasKey("years", $response[0]);        
        $this->assertArrayHasKey("major_path_wage", $response[0]);
    }

    public function test_getFREData_ensure_returns_all_keys()
    {
        $this->seed('Master_FRE_Page_Data_TableSeeder');
        $request = new Request();
        $request->major = 22021;
        $request->university = 70;
        $request->age_range = 2;
        $request->education_level = 'FTF';
        $request->annual_earnings = 3;
        $request->financial_aid = 2;
        
        $response = $this->majorService->getFREData($request);
        $this->arrayHasKey("student_background_id", $response);
        $this->arrayHasKey("annual_earnings_id", $response);
        $this->arrayHasKey("annual_financial_aid_id", $response);
        $this->arrayHasKey("time_to_degree", $response);
        $this->arrayHasKey("earnings_5_years", $response);
        $this->arrayHasKey("roi", $response);
    }

    // public function test_getAllUniversities_returns_7_univerities()
    // {
    //     $response = $this->majorService->getAllUniversities();
    //     $this->assertEquals(University::count(), count($response));
    // }
}