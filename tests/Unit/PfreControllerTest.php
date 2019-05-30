<?php

namespace Tests\Feature;

use App\Http\Controllers\PfreController;
use App\Contracts\PfreContract;
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

class PfreControllerTest extends TestCase
{
    use DatabaseMigrations;

    private $controller;
    private $retriever;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::mock(PfreContract::class);
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

        $this->seed("Investments_Template_Northridge_TableSeeder");
        $this->seed("Student_Backgrounds_Template_Northridge_TableSeeder");
        $this->seed('Pfre_TableSeeder');

        $this->controller = new PfreController($this->retriever);
    }

    /**
     * Api route : api/major/{major}/{university}/{age_range}/{education_level}/{annual_earnings}/{financial_aid}
     *  i.e : /api/major/5021/northridge/1/FTT/1/1
     * method : MajorController@getFREData
     * test is updated to hit the route, dependency injection does not work well with form requests
     */
    public function test_getFreData_Success_Contract_Call()
    {
        $entry_status       =   "FTT";
        $major              =   urlencode("Computer Engineering");
        $in_school_earning  =   0;
        $financial_aid      =   'fin_aid_0';

        $response = $this->json('POST', "/api/pfre/$entry_status/$in_school_earning/$financial_aid", ['major' => $major]);
        $response = $response->getOriginalContent();
        $response = json_encode($response);

        $actualResponse  = ["pfre" => "14%"];
        $actualResponse = json_encode($actualResponse);
        $this->assertEquals($response, $actualResponse);
    }

    /**
     * Api route : api/pfre/$entry_status/$major/$in_school_earning/$financial_aid
     * method : MajorController@getFREData
     * FRE - Financial Return On Investment, this function populates FRE page bar charts
     * Assert json structure 
     */
    public function test_getFREData_returns_time_to_degree_and_estimated_5_year_earnings_and_roi()
    {
        $entry_status       =   "FTT";
        $major              =   urlencode("Computer Engineering");
        $in_school_earning  =   0;
        $financial_aid      =   'fin_aid_0';

        $response = $this->json('POST', "/api/pfre/$entry_status/$in_school_earning/$financial_aid", ['major' => $major]);

        $response->assertJsonStructure([
            'pfre'
        ]);
    }
}
