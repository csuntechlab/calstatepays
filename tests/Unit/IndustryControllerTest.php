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
        $this->seed('Naics_Titles_TableSeeder');
    }

    public function testGetAllIndustryNaicsTitles()
    {
        // api route is
        // /api/industry/naics-titles
        // method is IndustryContrller@getAllIndustryNaicsTitles
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

     public function testGetIndustryPopulationByRankWithImages()
     {
         // route is
         // /api/industry/5021/northridge
         // method is IndustryContrller@getIndustryPopulationByRankWithImages
         $this->seed('University_Majors_TableSeeder');
         $this->seed('Master_Industry_Path_Types_Table_Seeder');
         $this->seed('Master_Industry_Wages_Table_Seeder');
         $this->seed('Population_Table_Seeder');
         $this->seed('Universities_TableSeeder');
         $response = $this->json('GET', '/api/industry/5021/northridge');
        //  dd($response);
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