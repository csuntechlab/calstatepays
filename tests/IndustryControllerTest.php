<?php

namespace Tests;

use App\Models\NaicsTitle;
use App\Models\UniversityMajor;
use App\Models\IndustryPathType;
use App\Models\Population;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class IndustryControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(){
        parent::setUp();

        //Build 4 tables which are related to each other.
        $this->a = factory(UniversityMajor::class,3)->create();
        $this->b = factory(Population::class, 20)->create();
        $this->c = factory(NaicsTitle::class, 18)->create()->each(function ($naicsTitle) {
            $naicsTitle->industryPathTypes()->save(factory(IndustryPathType::class)->make());
        });
    }

    public function testGetAllIndustryNaicsTitles()
    {
        $response = $this->json('GET', '/api/industry/naics-titles');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            0 => [
                'naics_code',
                'title',
                'image'
            ]
        ]);
    }

    public function testGetIndustryPopulationByRank()
    {
        $response = $this->json('GET', '/api/industry/22021/1153');
        $response->assertJsonStructure([
            0 => [
                'title',
                'percentage',
                'rank',
                'image'
            ]
        ]);
        $response->assertStatus(200);
    }
}