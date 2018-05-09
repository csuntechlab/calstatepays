<?php

namespace Tests\Feature;

use App\Models\StudentPath;
use App\Models\UniversityMajor;
use App\Models\MajorPath;
use App\Models\MajorPathWage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MajorControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(){
        parent::setUp();
        $this->seed('Hegis_Codes_TableSeeder');
        $this->seed('University_Majors_TableSeeder');
        $this->seed('Major_Paths_TableSeeder');
        $this->seed('Student_Paths_TableSeeder');
    }
    public function test_getAllHegisCodes_ReturnsSuccessJsonFormat()
    {
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

    public function test_withMajorPathWage_returns_related_table_data()
    {
        $hegis_code = 22021;
        $university_id = 1153;
        $data = UniversityMajor::allMajorPathWages($hegis_code,$university_id);
        $this->assertInternalType('array',$data);
        $this->assertCount(9, $data);
    }

}
