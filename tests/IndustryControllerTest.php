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
        $response = $this->json('GET', '/api/industry/naics-titles');
        $response->assertStatus(200);
        dd($response>count());
    }

}
