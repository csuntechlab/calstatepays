<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Services\IndustryService;

class IndustryServiceTest extends TestCase
{
    use DatabaseMigrations;
    protected $industryService;

    public function setUp()
    {
        parent::setUp();
        $this->industryService= new IndustryService();
    }

    public function test_getAllIndustryNaicsTitles_returns_all_rows()
    {
        $this->seed('Naics_Titles_TableSeeder');
        $response = $this->industryService->getAllIndustryNaicsTitles();
        $this->assertArrayHasKey("naics_code", $response[0]);    
        $this->assertArrayHasKey("title", $response[0]);        
        $this->assertArrayHasKey('image', $response[0]);
    }
}