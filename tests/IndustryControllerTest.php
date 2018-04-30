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

    // public function testGetAllIndustryNaicsTitles()
    // {
    //     for($i=0;$i<10;$i++){
    //         NaicsTitle::create(
    //             [
    //                 'naics_code'    => $i,
    //                 'naics_title'   => 'Title',
    //                 'image'         => 'image.jpg'
    //             ]
    //         );
    //     }
    //     $data = $this->IndustryController->getAllIndustryNaicsTitles();
    //     foreach($data as $key => $title ) {
    //         $this->assertEquals($key,$title['naics_code']);
    //         $this->assertEquals('Title',$title['title']);
    //         $this->assertEquals('image.jpg',$title['image']);
    //     }
    // }

    public function testGetIndustryPopulationByRank()
    {

        // factory(UniversityMajor::class, 5)->create();  
        $json = File::get("database/data/university_majors.json");  
        dd($json); 
        // factory(IndustryPathType::class, 5)->create(['university_majors_id' => 1]);
        // factory(Population::class, 5)->create();
           
        // $response = $this->IndustryController->getIndustryPopulationByRank(24511,1153);       
        // dd($response);
    }
}


//one funciton to test format
//one function to test the ranking functionality