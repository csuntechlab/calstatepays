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
    protected $pfreService;

    public function setUp()
    {
        parent::setUp();
        $this->pfreService = new PfreService();
        $this->seed('Hegis_Codes_TableSeeder');
        $this->seed('Naics_Titles_TableSeeder');
        $this->seed('Hegis_Categories_TableSeeder');

        $this->seed('Aggregate_Major_Path_TableSeeder');
        $this->seed('Aggregate_Major_Path_Wages_TableSeeder');
        $this->seed('Northridge_Major_Path_TableSeeder');
        $this->seed('Northridge_Major_Path_Wages_TableSeeder');

        $this->seed('Student_Backgrounds_Template_Northridge_TableSeeder');
        $this->seed('Student_Backgrounds_Template_All_TableSeeder');

        $this->seed('Investments_Template_Northridge_TableSeeder');
        $this->seed('Investments_Template_All_TableSeeder');

        $this->seed('Universities_TableSeeder');
        $this->seed('Pfre_TableSeeder');
    }

    public function test_fre_request()
    {
        $request = new Request();
        $request->entry_status      = 'FTF';
        $request->major             = 'Computer Engineering';
        $request->in_school_earning = 0;
        $request->financial_aid     = 2;

        $response = $this->pfreService->getFREData($request);

        $this->arrayHasKey("pfre", $response);
    }

    public function test_getFREData_throws_a_model_not_found_exception()
    {
        $request = new Request();
        $request->entry_status      = 'FTF';
        $request->major             = "ering";
        $request->in_school_earning = 1;
        $request->financial_aid     = 1;

        $expectedResponse = [
            "pfre" => "No data."
        ];
        $response = $this->pfreService->getFREData($request);
        $this->assertEquals($response, $expectedResponse);
    }
}
