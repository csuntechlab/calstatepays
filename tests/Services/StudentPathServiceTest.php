<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Services\StudentPathService;
use App\Models\StudentPath;

class StudentPathServiceTest extends TestCase
{
    use DatabaseMigrations;
    protected $studentPathService;
    
    public function setUp(){
        parent::setUp();
        $this->studentPathService = new StudentPathService();
    }

    public function test_getAllStudentPaths_has_all_keys() 
    {
        $this->seed('Student_Paths_TableSeeder');
        $response = $this->studentPathService->getAllStudentPaths();
        $this->arrayHasKey("id", $response[0]);
        $this->arrayHasKey("name", $response[0]);
    }
}