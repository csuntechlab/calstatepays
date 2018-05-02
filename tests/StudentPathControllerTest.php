<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StudentPathControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllStudentPaths()
    {
        $this->artisan('db:seed');
        $response = $this->json('GET','/api/student-path');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '0' => [
                'id',
                'name'
            ]
        ]);
    }
}
