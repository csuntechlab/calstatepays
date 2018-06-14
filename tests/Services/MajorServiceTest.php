<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\HEGISCode;
use App\Services\MajorService;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MajorServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testgetAllHegisCodes_ensure_returns_all_rows() {
        $majorService = new MajorService();
        //given i have a populated database of hegis codes
        $this->seed('Hegis_Codes_TableSeeder');
        //when i'm grabbing the hegis codes
        $response = $majorService->getAllHegisCodes();
        //expected
        // dd($response);
        $this->arrayHasKey(0, $response);
        $this->arrayHasKey("hegis_code", $response[0]);
        $this->arrayHasKey("major", $response[0]);
        $this->arrayHasKey("university", $response[0]);
        $this->assertEquals(HEGISCode::count(), count($response));
    }
}