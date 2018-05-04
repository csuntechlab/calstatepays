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
            $university = UniversityMajor::create(
                [
                    'hegis_code' => $row->hegis_code,
                    'colledge_id' => $row->college_id,
                    'university_id' => $row->university_id
                ]
            );
            factory(IndustryPathType::class, 1)->create(['university_majors_id' => $university->id, 'population_sample_id' => $university->id]);
            factory(Population::class, 1)->create(['id' => $university->id]);
            factory(NaicsTitle::class)->create();
        }
         //dd(UniversityMajor::all());
             /*dd(IndustryPathType::all());*/
         //dd(Population::all());
         $response = $this->json('GET', 'industry/22021/1153');
        dd($response);
    }
}


//one funciton to test format
//one function to test the ranking functionality