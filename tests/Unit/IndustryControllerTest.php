<?php

namespace Tests;

use App\Models\NaicsTitle;
use App\Models\UniversityMajor;
use App\Models\IndustryPathType;
use App\Models\Population;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Controllers\IndustryController;
use App\Contracts\IndustryContract;
use Mockery;

class IndustryControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected $mockIndustryContract = null;

    public function setUp(){
        parent::setUp();
        $this->mockIndustryContract = Mockery::spy(IndustryContract::class);
    }

    public function testGetAllIndustryNaicsTitles()
    {
        $data = json_encode([
            [
                'naics_code' => 1,
                'title' => 'Agriculture, Forestry, Fishing, & Hunting',
                'image' => 'images/industry/agriculture_forestry_fishing_hunting.png'
            ],
        ]);

        // api route is
        // /api/industry/naics-titles
        // method is IndustryContrller@getAllIndustryNaicsTitles
        $this->mockIndustryContract
            ->shouldReceive('getAllIndustryNaicsTitles')
            ->once()
            ->andReturn($data);

        $controller = new IndustryController($this->mockIndustryContract);
        $response = $controller->getAllIndustryNaicsTitles();
        $this->assertEquals($response,$data);
    }

    public function testGetAllIndustryNaicsTitlesReturns200Status()
    {
        $this->seed('Naics_Titles_TableSeeder');
        $response = $this->json('GET', '/api/industry/naics-titles');
        $response->assertStatus(200);
    }

     public function testGetIndustryPopulationByRankWithImages()
     {
        $data = json_encode([
            [
                'naics_code' => 1,
                'title' => 'Agriculture, Forestry, Fishing, & Hunting',
                'image' => 'images/industry/agriculture_forestry_fishing_hunting.png'
            ],
        ]);
        
         // route is
         // /api/industry/5021/northridge
         // method is IndustryContrller@getIndustryPopulationByRankWithImages
         $this->mockIndustryContract
         ->shouldReceive('getIndustryPopulationByRankWithImages')
         ->once()
         ->andReturn($data);

        $controller = new IndustryController($this->mockIndustryContract);
        $response = $controller->getIndustryPopulationByRankWithImages();
        $this->assertEquals($response,$data);

     }

     public function testGetIndustryPopulationByRankWithImagesReturns200Status()
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
         $response->assertStatus(200);
     }
}