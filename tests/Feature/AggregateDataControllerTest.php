<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Http\Controllers\AggregateDataController;
use App\Models\NaicsTitle;
use App\Models\IndustryPathType;
use App\Models\IndustryWage;
use App\Models\MajorPath;
use App\Models\MajorPathWage;

class AggregateDataControllerTest extends TestCase
{
	use DatabaseMigrations;

    public function setUp(){
        $this->markTestSkipped();
        parent::setUp();
        $this->aggregateDataController = new AggregateDataController;
    }


    public function testGetAverageIncomeByStudentPath()
    {
        $entry_status = 'FTF';
        $years = [2, 5, 10];
        $id = 1;
        $university_majors_id = 1;
        $averages=['1'=>[],'2'=>[],'3'=>[]];
        foreach($years as $year){
            for($i=1;$i<=3;$i++){
                for($j=1;$j<=3;$j++){
                    $student_path = $i;
                    $major_path_id = $id++;
                    $avg_annual_wage = random_int(30000,60000);
                    array_push($averages[$i],$avg_annual_wage);
                    MajorPath::create(
                        [
                            'id' => $major_path_id,
                            'student_path' => $student_path,
                            'university_majors_id' => $university_majors_id++,
                            'entry_status' => $entry_status,
                            'years' => $year

                        ]
                    );
                    MajorPathWage::create(
                        [
                            'major_path_id' => $major_path_id,
                            'avg_annual_wage' => $avg_annual_wage,
                            '25th' => random_int(30000,40000),
                            '50th' => random_int(40000,50000),
                            '75th' => random_int(50000,60000),
                            'population_sample_id' => random_int(1,9999)
                        ]
                    );
                }
            }
        }

        foreach ($averages as $average_number => $average){
            $averages[$average_number] = array_sum($averages[$average_number])/count($averages[$average_number]);
        }
        $data = $this->aggregateDataController->getAverageIncomeByStudentPath();
        $this->assertEquals($averages['1'],$data['some_college_avg']);
        $this->assertEquals($averages['2'],$data['bachelors_avg']);
        $this->assertEquals($averages['3'],$data['masters_avg']);

    }

    public function testGetAverageIncomeByIndustry()
    {
    	$naics_code = rand(0,1000);
    	$naics_title = str_random(15);
    	
        $avg_annual_wage_5_1 = rand(0,100000);
    	$avg_annual_wage_10_1 = rand(50000,150000);
        
        $avg_annual_wage_5_2 = rand(0,100000);
        $avg_annual_wage_10_2 = rand(50000,150000);

        $avg_annual_wage_5_total = ($avg_annual_wage_5_1+$avg_annual_wage_5_2)/2;
        $avg_annual_wage_10_total = ($avg_annual_wage_10_1+$avg_annual_wage_10_2)/2;

    	$industry_path_id = 1;
    	
    	NaicsTitle::create(
    		[
                'naics_code' => $naics_code,
                'naics_title' => $naics_title
    		]
    	);
    	IndustryPathType::create(
    		[
                'id' => $industry_path_id,
        		'entry_status' => "FTF",
        		'naics_code' => $naics_code,
        		'student_path' => '1',
        		'population_sample_id' => rand(100,10000),
        		'university_majors_id' => rand(100,1000)
    		]
    	);
        IndustryPathType::create(
            [
                'id' => $industry_path_id+1,
                'entry_status' => "TTF",
                'naics_code' => $naics_code,
                'student_path' => '1',
                'population_sample_id' => rand(100,10000),
                'university_majors_id' => rand(100,1000)
            ]
        );

        IndustryWage::create(
        	[
                'id' => $industry_path_id,
            	'avg_annual_wage_5' => $avg_annual_wage_5_1,
            	'avg_annual_wage_10' => $avg_annual_wage_10_1
        	]
        );
        IndustryWage::create(
            [
                'id' => $industry_path_id+1,
                'avg_annual_wage_5' => $avg_annual_wage_5_2,
                'avg_annual_wage_10' => $avg_annual_wage_10_2
            ]
        );

    	$data = $this->aggregateDataController->getAverageIncomeByIndustry();
        
        $testData  = $data[$naics_code];

   		$this->assertEquals($naics_code,  $testData['naics_code']);
   		$this->assertEquals($naics_title,  $testData['naics_title']);
   		$this->assertEquals($avg_annual_wage_5_total,  $testData['avg_annual_wage_5']);
   		$this->assertEquals($avg_annual_wage_10_total, $testData['avg_annual_wage_10']);
    }
}