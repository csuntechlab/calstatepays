<?php

namespace Tests\Feature;

use App\Http\Controllers\MajorController;
use App\Models\StudentPath;
use App\Models\UniversityMajor;
use App\Models\MajorPath;
use App\Models\MajorPathWage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MajorControllerTest extends TestCase
{
    use DatabaseMigrations;

    private $controller;

    private $validMajorId = 22021;
    private $validUniversity = 1153;

    public function setUp(){
        parent::setUp();
        $this->controller = new MajorController();
        $this->seed('Hegis_Codes_TableSeeder');
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Major_Paths_TableSeeder');
        $this->seed('Student_Paths_TableSeeder');
    }
    public function test_getAllHegisCodes_ReturnsSuccessJsonFormat()
    {
        $response = $this->json('GET', '/api/major/hegis-codes');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            0 => [
                'hegis_code',
                'major',
                'university'
            ]
        ]);
    }

    public function test_getMajorEarnings_returns_data_for_3_paths()
    {
        $response = $this->get('/api/major/'.$this->validMajorId.'/'.$this->validUniversity);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'majorId',
            'universityId',
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
                '25th'     => 30000,
                '50th'     => 45000,
                '75th'     => 60000
            ]
        ];
        $returnedArray = $this->controller->extractWageByYearKey($testData);
        $this->assertEquals([
                'avg_wage' => 50000,
                '25th'     => 30000,
                '50th'     => 45000,
                '75th'     => 60000], $returnedArray);
    }

    //FRE - Financial Return On Investment, this function populates FRE page bar charts
    public function test_getFREData_returns_time_to_degree_and_estimated_5_year_earnings_and_roi()
    {
        $major = 5011;
        $university = 1153;
        $age_range = 1;
        $education_level = 'FTT';
        $annual_earnings = 2;
        $financial_aid = 3;
        $response = $this->get("/api/major/$major/$university/$age_range/$education_level/$annual_earnings/$financial_aid");
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
