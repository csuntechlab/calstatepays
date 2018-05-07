<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MajorControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_getAllHegisCodes_ReturnsSuccessJsonFormat()
    {
        $this->seed('Hegis_Codes_TableSeeder');
        $response = $this->json('GET', '/api/major/hegis-codes');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            0 => [
                'hegis_code',
                'major',
                'university'
            ]
        ]);
    }
}
