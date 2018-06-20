<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\FieldOfStudy;
use App\Models\HEGISCode;
use App\Services\MajorService;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MajorServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function test_getAllHegisCodes_ensure_returns_all_rows() {
        $majorService = new MajorService();
        $this->seed('Hegis_Codes_TableSeeder');
        $response = $majorService->getAllHegisCodes();

        $this->arrayHasKey(0, $response);
        $this->arrayHasKey("hegis_code", $response[0]);
        $this->arrayHasKey("major", $response[0]);
        $this->arrayHasKey("university", $response[0]);
        $this->assertEquals(HEGISCode::count(), count($response));
    }

    public function test_getAllFieldOfStudies_ensure_returns_all_rows() {
        $majorService = new MajorService();
        $this->seed('Field_Of_Studies_TableSeeder');
        $response = $majorService->getAllFieldOfStudies();

        $this->arrayHasKey("name", $response[0]);        
        $this->arrayHasKey("id", $response[0]);        
        $this->assertEquals(FieldOfStudy::count(), count($response));
    }

    public function test_getHegisCategories_ensure_returns_hegis_categories_as_array() {
        $majorService = new MajorService();
        $this->seed('Field_Of_Studies_TableSeeder');
        $this->seed('Hegis_Categories_TableSeeder');
        $this->seed('Hegis_Codes_TableSeeder');
        $fieldOfStudyId = 1;
        $response = $majorService->getHegisCategories($fieldOfStudyId);

        $this->arrayHasKey("hegisCode", $response[0]);
        $this->arrayHasKey("hegis_category_id", $response[0]);
        $this->arrayHasKey("major", $response[0]);
    }
}