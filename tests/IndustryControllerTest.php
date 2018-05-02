<?php

namespace Tests;

use App\Http\Controllers\IndustryController;
use App\Models\NaicsTitle;
use App\Models\UniversityMajor;
use App\Models\IndustryPathType;
use App\Models\Population;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Artisan;
use File;

class IndustryControllerTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp(){
        parent::setUp();
        $this->IndustryController = new IndustryController;
    }

    public function testGetAllIndustryNaicsTitles()
    {
        $this->artisan("db:seed");
        $response = $this->json('GET', '/api/industry/naics-titles');
        $response->assertStatus(200);
    }

    public function testGetIndustryPopulationByRank()
    {

        $json = File::get("database/data/university_majors.json");  
        $universityMajorData = json_decode($json);
        foreach($universityMajorData as $row) 
        {
            UniversityMajor::create(
                [
                    'hegis_code' => $row->hegis_code,
                    'colledge_id' => $row->college_id,
                    'university_id' => $row->university_id
                ]
            );
            factory(IndustryPathType::class, 1)->create(['university_majors_id' => $row->id, 'population_sample_id' => $row->id]);
            factory(Population::class, 1)->create(['id' => $row->id]);            
        }
        // dd(UniversityMajor::all());
        // dd(IndustryPathType::all());
        // dd(Population::all());
        
        
        $response = $this->IndustryController->getIndustryPopulationByRank(22021,1153);  
        // $response = $this->json('GET', '/api/student-paths');  
        dd($response);
        $response = json_decode($response->getContent(), true);  
    }
}


//one funciton to test format
//one function to test the ranking functionality