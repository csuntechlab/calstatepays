<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UniversityControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllUniversities()
    {
        $this->artisan('db:seed');
        $response = $this->json('GET', '/api/university');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '0' =>[
                'id',
                'university_name'
            ]
        ]);
    }
}
