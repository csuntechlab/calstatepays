<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\FieldOfStudy;
use App\Models\HEGISCode;
use App\Models\University;
use App\Models\UniversityMajor;
use App\Services\PfreService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PfreServiceTest extends TestCase
{
    use DatabaseMigrations;
    protected $majorService;
    public function setUp()
    {
        parent::setUp();
        $this->majorService = new PfreService();
        $this->seed('Hegis_Codes_TableSeeder');
        $this->seed('Naics_Titles_TableSeeder');
        $this->seed('Student_Paths_TableSeeder');
        $this->seed('Hegis_Categories_TableSeeder');

        $this->seed('Aggregate_Major_Path_TableSeeder');
        $this->seed('Aggregate_Major_Path_Wages_TableSeeder');
        $this->seed('Northridge_Major_Path_TableSeeder');
        $this->seed('Northridge_Major_Path_Wages_TableSeeder');
    }

    public function test_Aggregate_getFREData_ensure_returns_all_keys()
    {
        $this->seed('Universities_TableSeeder');
        $this->seed('Aggregate_University_Majors_TableSeeder');
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

    public function test_getFREData_ensure_returns_all_keys()
    {
        $this->seed('Universities_TableSeeder');
        $this->seed('Northridge_University_Majors_TableSeeder');
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
}
