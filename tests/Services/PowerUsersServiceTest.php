<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Services\PowerUsersService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PowerUsersServiceTest extends TestCase
{
    use DatabaseMigrations;
    protected $powerUserService;

    public function setUp()
    {
        parent::setUp();
        $this->powerUserService = new PowerUsersService();
        $this->seed('Universities_TableSeeder');
    }

    /**
     * Test the university image link and return proper json
     */
    public function test_getUniversityImage(){
        $this->seed('Power_User_Card_Images_TableSeeder');
        $university_image = asset("/img/csucampuses/allcsu.png");
        $response = $this->powerUserService->getPowerUsersCardImages();
        $this->assertEquals($university_image,$response[0]["card_image"]);
    }
}
