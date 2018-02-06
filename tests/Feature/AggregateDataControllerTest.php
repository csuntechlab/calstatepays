<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Http\Controllers\AggregateDataController;
use App\NaicsTitle;
use App\IndustryPathType;
use App\IndustryWage;

class AggregateDataControllerTest extends TestCase
{
	use DatabaseMigrations;

    public function setUp(){
        parent::setUp();
        $this->aggregateDataController = new AggregateDataController;
    }

    public function testGetAverageIncomeByIndustry()
    {
    	$naics_code = rand(0,1000);
    	$naics_title = str_random(15);
    	$avg_annual_wage_5 = rand(0,100000);
    	$avg_annual_wage_10 = rand(50000,150000);
    	$industry_path_id = 1;
    	
    	NaicsTitle::create(
    		['naics_code' => $naics_code,
    		 'naics_title' => $naics_title
    		]
    	);
    	IndustryPathType::create(
    		['id' => $industry_path_id,
    		'entry_status' => "FTF",
    		'naics_code' => $naics_code,
    		'student_path' => '1',
    		'population_sample_id' => rand(100,10000),
    		'university_majors_id' => rand(100,1000)
    		]
    	);
        IndustryWage::create(
        	['id' => $industry_path_id,
        	 'avg_annual_wage_5' => $avg_annual_wage_5,
        	 'avg_annual_wage_10' => $avg_annual_wage_10
        	]
        );

    	$data = $this->aggregateDataController->getAverageIncomeByIndustry();
    	$content = (json_decode($data, true))[0];
   
   		$this->assertEquals($naics_code,$content['naics_code']);
   		$this->assertEquals($naics_title,$content['naics_title']);
   		$this->assertEquals($avg_annual_wage_5, $content['industry_wage'][0]['avg_annual_wage_5']);
   		$this->assertEquals($avg_annual_wage_10, $content['industry_wage'][0]['avg_annual_wage_10']);
    }
}
