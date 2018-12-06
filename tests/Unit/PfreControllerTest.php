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
        $this->seed('Student_Paths_TableSeeder');
        $this->seed('Field_Of_Studies_TableSeeder');
        $this->seed('Hegis_Categories_TableSeeder');
        $this->seed('Universities_TableSeeder');

        $this->seed('Aggregate_Major_Path_TableSeeder');
        $this->seed('Aggregate_Major_Path_Wages_TableSeeder');
        $this->seed('Aggregate_University_Majors_TableSeeder');

        $this->seed('Northridge_Major_Path_TableSeeder');
        $this->seed('Northridge_Major_Path_Wages_TableSeeder');
        $this->seed('Northridge_University_Majors_TableSeeder');

        $this->seed('Master_FRE_Page_Data_TableSeeder');
        $this->seed("Investments_Template_Northridge_TableSeeder");

        $this->controller = new PfreController($this->retriever);
    }

    /**
     * Api route : api/major/{major}/{university}/{age_range}/{education_level}/{annual_earnings}/{financial_aid}
     *  i.e : /api/major/5021/northridge/1/FTT/2/3
     * method : MajorController@getFREData
     * test uses dependency injection 
     */
    public function test_getFreData_Success_Contract_Call()
    {
        $university = "northridge";
        $major = 4011;
        $age_range = 1;
        $education_level = 1;
        $annual_earnings = 2;

        $response = $this->json('GET', "/api/major/$major/$university/$age_range/$education_level/$annual_earnings/$financial_aid");

        $contractResponse =
            ["id" => 1927, "student_background_id" => 81, "annual_earnings_id" => 2, "annual_financial_aid_id" => 3, "time_to_degree" => 3, "earnings_5_years" => 45000, "roi" => "4.30"];

        $test =
            ["majorId" => "5021", "universityId" => "northridge", "fre" => ["timeToDegree" => 3, "earningsYearFive" => 45000, "returnOnInvestment" => "4.30"]];

        $this->retriever
            ->shouldReceive('getFREData')
            ->with($request)
            ->once()->andReturn($contractResponse);

        $response = $this->controller->getFREData($request);

        $this->assertEquals($test, $response);
    }

    /**
     * Api route : api//major/{major}/{university}/{age_range}/{education_level}/{annual_earnings}/{financial_aid}
     * method : MajorController@getFREData
     * FRE - Financial Return On Investment, this function populates FRE page bar charts
     * Assert json structure 
     */
    public function test_getFREData_returns_time_to_degree_and_estimated_5_year_earnings_and_roi()
    {
        $major = 5021;
        $university = 'northridge';
        $age_range = 1;
        $education_level = 'FTT';
        $annual_earnings = 2;
        $financial_aid = 3;
        $response = $this->json('GET', "/api/major/$major/$university/$age_range/$education_level/$annual_earnings/$financial_aid");
        $response->assertJsonStructure([
            'majorId',
            'universityId',
            'fre' => [
                'timeToDegree',
                'earningsYearFive',
                'returnOnInvestment'
            ]
        ]);
    }

}
