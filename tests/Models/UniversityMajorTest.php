<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\UniversityMajor;

class UniversityMajorTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->seed('University_Majors_Test_TableSeeder');

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
