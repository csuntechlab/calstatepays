<?php

namespace Tests;

use App\Http\Controllers\IndustryController;
use App\Models\NaicsTitle;
use Illuminate\Foundation\Testing\DatabaseMigrations;


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
        $data = $this->IndustryController->getAllIndustryNaicsTitles();
        foreach($data as $key => $title ) {
            $this->assertEquals($key,$title['naics_code']);
            $this->assertEquals('Title',$title['title']);
            $this->assertEquals('image.jpg',$title['image']);
        }
    }

}
