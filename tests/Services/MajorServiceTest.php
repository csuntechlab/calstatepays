<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\FieldOfStudy;
use App\Models\HEGISCode;
use App\Models\UniversityMajor;
use App\Services\MajorService;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MajorServiceTest extends TestCase
{
    use DatabaseMigrations;
    protected $majorService;
    
    public function setUp(){
        parent::setUp();
        $this->majorService = new MajorService();
    }

    public function test_getAllHegisCodes_ensure_returns_all_rows() {
        $this->seed('Hegis_Codes_TestTableSeeder');
        $response = $this->majorService->getAllHegisCodes();

        $this->arrayHasKey(0, $response);
        $this->arrayHasKey("hegis_code", $response[0]);
        $this->arrayHasKey("major", $response[0]);
        $this->arrayHasKey("university", $response[0]);
        $this->assertEquals(HEGISCode::count(), count($response));
    }

    public function test_getAllFieldOfStudies_ensure_returns_all_rows() {
        $this->seed('Field_Of_Studies_TableSeeder');
        $response = $this->majorService->getAllFieldOfStudies();

        $this->arrayHasKey("name", $response[0]);        
        $this->arrayHasKey("id", $response[0]);
        $removeUndeclared = 1;        
        $this->assertEquals(FieldOfStudy::count() - $removeUndeclared, count($response));
    }

    public function test_getMajorEarnings_ensure_returns_all_major_path_wages(){
        $this->seed('University_Majors_Test_TableSeeder');
        $response = $this->majorService->getMajorEarnings(22021, 1153);
        $this->arrayHasKey("id", $response[0]);        
        $this->arrayHasKey("student_path", $response[0]);    
        $this->arrayHasKey("university_majors_id", $response[0]);        
        $this->arrayHasKey("entry_status", $response[0]);
        $this->arrayHasKey("years", $response[0]);        
        $this->arrayHasKey("major_path_wage", $response[0]);
    }
}