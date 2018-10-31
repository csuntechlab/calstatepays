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
        $this->controller = new MajorController($this->retriever);
    }

    /**
     * Api route : api/major/hegis-codes/university/{university_name}
     * method : MajorController@getAllHegisCodes
     * test uses dependency injection 
     */
    public function test_getAllHegisCodes_ReturnsSuccessJsonFormat()
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
     * method : MajorController@getAllFieldOfStudeies
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
     * Api route : api/major/{major}/{university}
     * ie : api/major/5021/northridge
     * method : MajorController@getMajorEarnings
     * test uses dependency injection 
     */
    public function test_getMajorEarnings_Success_Contract_Call()
    {
        $major = 5021;
        $universityName = "northridge";

        $contractResponse =
            [["id" => 721, "student_path" => 1, "university_majors_id" => 11, "entry_status" => "FTT", "years" => 2, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 721, "_25th" => 40269, "_50th" => 54918, "_75th" => 63510]], ["id" => 722, "student_path" => 1, "university_majors_id" => 11, "entry_status" => "FTT", "years" => 5, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 722, "_25th" => 47361, "_50th" => 66685, "_75th" => 82003]], ["id" => 723, "student_path" => 1, "university_majors_id" => 11, "entry_status" => "FTT", "years" => 10, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 723, "_25th" => 54443, "_50th" => 81265, "_75th" => 108607]], ["id" => 724, "student_path" => 1, "university_majors_id" => 11, "entry_status" => "FTT", "years" => 15, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 724, "_25th" => 62532, "_50th" => 96471, "_75th" => 135505]], ["id" => 1065, "student_path" => 2, "university_majors_id" => 11, "entry_status" => "FTF + FTT", "years" => 2, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 1065, "_25th" => 13926, "_50th" => 26733, "_75th" => 42139]], ["id" => 1749, "student_path" => 2, "university_majors_id" => 11, "entry_status" => "FTT", "years" => 2, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 1749, "_25th" => 17371, "_50th" => 33131, "_75th" => 50304]], ["id" => 1750, "student_path" => 2, "university_majors_id" => 11, "entry_status" => "FTT", "years" => 5, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 1750, "_25th" => 25766, "_50th" => 44717, "_75th" => 64515]], ["id" => 1751, "student_path" => 2, "university_majors_id" => 11, "entry_status" => "FTT", "years" => 10, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 1751, "_25th" => 26708, "_50th" => 50967, "_75th" => 75700]], ["id" => 1752, "student_path" => 2, "university_majors_id" => 11, "entry_status" => "FTT", "years" => 15, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 1752, "_25th" => 27044, "_50th" => 54115, "_75th" => 86863]], ["id" => 2093, "student_path" => 4, "university_majors_id" => 11, "entry_status" => "FTF + FTT", "years" => 2, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 2093, "_25th" => 60856, "_50th" => 78283, "_75th" => 103575]], ["id" => 2753, "student_path" => 4, "university_majors_id" => 11, "entry_status" => "FTT", "years" => 2, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 2753, "_25th" => 60925, "_50th" => 78542, "_75th" => 103504]], ["id" => 2754, "student_path" => 4, "university_majors_id" => 11, "entry_status" => "FTT", "years" => 5, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 2754, "_25th" => 67620, "_50th" => 95069, "_75th" => 121142]], ["id" => 2755, "student_path" => 4, "university_majors_id" => 11, "entry_status" => "FTT", "years" => 10, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 2755, "_25th" => 79059, "_50th" => 115360, "_75th" => 148776]], ["id" => 2756, "student_path" => 4, "university_majors_id" => 11, "entry_status" => "FTT", "years" => 15, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 2756, "_25th" => null, "_50th" => null, "_75th" => null]]];

        $test =
            ["majorId" => 5021, "universityName" => "northridge", "someCollege" => ["2" => ["major_path_id" => 1749, "_25th" => 17371, "_50th" => 33131, "_75th" => 50304], "5" => ["major_path_id" => 1750, "_25th" => 25766, "_50th" => 44717, "_75th" => 64515], "10" => ["major_path_id" => 1751, "_25th" => 26708, "_50th" => 50967, "_75th" => 75700], "15" => ["major_path_id" => 1752, "_25th" => 27044, "_50th" => 54115, "_75th" => 86863]], "bachelors" => ["2" => ["major_path_id" => 721, "_25th" => 40269, "_50th" => 54918, "_75th" => 63510], "5" => ["major_path_id" => 722, "_25th" => 47361, "_50th" => 66685, "_75th" => 82003], "10" => ["major_path_id" => 723, "_25th" => 54443, "_50th" => 81265, "_75th" => 108607], "15" => ["major_path_id" => 724, "_25th" => 62532, "_50th" => 96471, "_75th" => 135505]], "postBacc" => ["2" => ["major_path_id" => 2753, "_25th" => 60925, "_50th" => 78542, "_75th" => 103504], "5" => ["major_path_id" => 2754, "_25th" => 67620, "_50th" => 95069, "_75th" => 121142], "10" => ["major_path_id" => 2755, "_25th" => 79059, "_50th" => 115360, "_75th" => 148776], "15" => ["major_path_id" => 2756, "_25th" => null, "_50th" => null, "_75th" => null]]];

        $this->retriever
            ->shouldReceive('getMajorEarnings')
            ->with($major, $universityName)
            ->once()->andReturn($contractResponse);

        $response = $this->controller->getMajorEarnings($major, $universityName);
        $this->assertEquals($test, $response);
    }

    /**
     * Api route : api//major/{major}/{university}/{age_range}/{education_level}/{annual_earnings}/{financial_aid}
     *  i.e : /api/major/5021/northridge/1/FTT/2/3
     * method : MajorController@getFREData
     * test uses dependency injection 
     */
    public function test_getFreData_Success_Contract_Call()
    {
        $universityName = "northridge";

        $request = new \Illuminate\Http\Request();
        $request->major = 5021;
        $request->university = $universityName;
        $request->age_range = 1;
        $request->education_level = 'FTT';
        $request->annual_earnings = 2;
        $request->financial_aid = 3;

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
        $major = 22021;
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

    /**
     * Api route : api/major/hegis-codes/{universityName}/{fieldOfStudyId}
     * method : MajorController@filterByFieldOfStudy
     * FRE - Financial Return On Investment, this function populates FRE page bar charts
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
<<<<<<< HEAD
         $response = $response->getOriginalContent();
         $count = count($response[0]);
         $this->assertEquals($countOfExpectedDropdowns, $count);
     }

     /**
      * Aggregate earning test
      * api is /api/major/5021/all
      */
     public function test_Aggregate_major_earnings()
     {
         $input = [
            'major' => 5021,
            'university' =>'all'
         ];

        $request = new MajorFormRequest($input);

        $request->replace(['major',5021]);

        // dd($request->all());

        $serviceResponse = [  0 =>  ["id" => 1133,"student_path" => 1,"university_majors_id" => 114,"entry_status" => "FTF + FTT","years" => 2,"potential_number_of_students" => 1,"major_path_wage" =>  ["major_path_id" => 1133,"_25th" => 37054,"_50th" => 52538,"_75th" => 61637,]],1 => ["id" => 1134,"student_path" => 1,"university_majors_id" => 114,"entry_status" => "FTF + FTT","years" => 5,"potential_number_of_students" => 1,"major_path_wage" =>  ["major_path_id" => 1134,"_25th" => 46624,"_50th" => 65392,"_75th" => 80988,]],2 => ["id" => 1135,"student_path" => 1,"university_majors_id" => 114,"entry_status" => "FTF + FTT","years" => 10,"potential_number_of_students" => 1,"major_path_wage" => ["major_path_id" => 1135,"_25th" => 54709,"_50th" => 80466,"_75th" => 104968,]],3 => ["id" => 1136,"student_path" => 1,"university_majors_id" => 114,"entry_status" => "FTF + FTT","years" => 15,"potential_number_of_students" => 1,"major_path_wage" =>  ["major_path_id" => 1136,"_25th" => 65692,"_50th" => 96147,"_75th" => 134611,]]];

        $test =  ["majorId" => 5021,"universityName" => "all","someCollege" => [2 =>  ["_25th" => null,"_50th" => null,"_75th" => null,],5 =>  ["_25th" => null,"_50th" => null,"_75th" => null,],10 =>  ["_25th" => null,"_50th" => null,"_75th" => null,],15 =>  ["_25th" => null,"_50th" => null,"_75th" => null,]],"bachelors" =>  [2 =>  ["major_path_id" => 1133,"_25th" => 37054,"_50th" => 52538,"_75th" => 61637,],5 =>  ["major_path_id" => 1134,"_25th" => 46624,"_50th" => 65392,"_75th" => 80988,],10 =>  ["major_path_id" => 1135,"_25th" => 54709,"_50th" => 80466,"_75th" => 104968,],15 =>  ["major_path_id" => 1136,"_25th" => 65692,"_50th" => 96147,"_75th" => 134611,]],"postBacc" =>  [2 => ["_25th" => null,"_50th" => null,"_75th" => null,],5 =>  ["_25th" => null,"_50th" => null,"_75th" => null,],10 =>  ["_25th" => null,"_50th" => null,"_75th" => null,],15 => ["_25th" => null,"_50th" => null,"_75th" => null,]]];

         $this->retriever
                ->shouldReceive('getMajorEarnings')
                ->once()
                ->with($request->major,$request->university)
                ->andReturn($serviceResponse);

         $response = $this->controller->getMajorEarnings($request);
         $this->assertEquals($test,$response);
     }

     /**
      *  major/hegis-codes/university/{university_name}
      *  major/hegis-codes/university/all
      */
     public function test_Aggregate_api_for_earnings()
     {
=======
        $response = $response->getOriginalContent();
        $count = count($response[0]);
        $this->assertEquals($countOfExpectedDropdowns, $count);
    }

    /**
     * Aggregate earning test
     * api is /api/major/5021/all
     */
    public function test_Aggregate_major_earnings()
    {
        $major = 5021;
        $universityName = 'all';

        $serviceResponse = [0 => ["id" => 1133, "student_path" => 1, "university_majors_id" => 114, "entry_status" => "FTF + FTT", "years" => 2, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 1133, "_25th" => 37054, "_50th" => 52538, "_75th" => 61637, ]], 1 => ["id" => 1134, "student_path" => 1, "university_majors_id" => 114, "entry_status" => "FTF + FTT", "years" => 5, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 1134, "_25th" => 46624, "_50th" => 65392, "_75th" => 80988, ]], 2 => ["id" => 1135, "student_path" => 1, "university_majors_id" => 114, "entry_status" => "FTF + FTT", "years" => 10, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 1135, "_25th" => 54709, "_50th" => 80466, "_75th" => 104968, ]], 3 => ["id" => 1136, "student_path" => 1, "university_majors_id" => 114, "entry_status" => "FTF + FTT", "years" => 15, "potential_number_of_students" => 1, "major_path_wage" => ["major_path_id" => 1136, "_25th" => 65692, "_50th" => 96147, "_75th" => 134611, ]]];

        $test = ["majorId" => 5021, "universityName" => "all", "someCollege" => [2 => ["_25th" => null, "_50th" => null, "_75th" => null, ], 5 => ["_25th" => null, "_50th" => null, "_75th" => null, ], 10 => ["_25th" => null, "_50th" => null, "_75th" => null, ], 15 => ["_25th" => null, "_50th" => null, "_75th" => null, ]], "bachelors" => [2 => ["major_path_id" => 1133, "_25th" => 37054, "_50th" => 52538, "_75th" => 61637, ], 5 => ["major_path_id" => 1134, "_25th" => 46624, "_50th" => 65392, "_75th" => 80988, ], 10 => ["major_path_id" => 1135, "_25th" => 54709, "_50th" => 80466, "_75th" => 104968, ], 15 => ["major_path_id" => 1136, "_25th" => 65692, "_50th" => 96147, "_75th" => 134611, ]], "postBacc" => [2 => ["_25th" => null, "_50th" => null, "_75th" => null, ], 5 => ["_25th" => null, "_50th" => null, "_75th" => null, ], 10 => ["_25th" => null, "_50th" => null, "_75th" => null, ], 15 => ["_25th" => null, "_50th" => null, "_75th" => null, ]]];

        $this->retriever
            ->shouldReceive('getMajorEarnings')
            ->once()
            ->with($major, $universityName)
            ->andReturn($serviceResponse);

        $response = $this->controller->getMajorEarnings($major, $universityName);
        $this->assertEquals($test, $response);
    }

    /**
     *  major/hegis-codes/university/{university_name}
     *  major/hegis-codes/university/all
     */
    public function test_Aggregate_api_for_earnings()
    {
>>>>>>> dev
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
<<<<<<< HEAD
        $this->assertEquals($response,$structure);
     }


=======
        $this->assertEquals($response, $structure);
    }
>>>>>>> dev
}
