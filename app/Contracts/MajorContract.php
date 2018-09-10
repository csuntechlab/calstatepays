<?php

namespace App\Contracts;

interface MajorContract
{
    public function getAllHegisCodesByUniversity( $universityId ): array;

    public function getAllFieldOfStudies(): array;

    public function getHegisCategories($universityId,$fieldOfStudyId): array;
    
    public function getMajorEarnings($hegis_code, $university_id): array;

    public function getFREData($request);

    public function getAllUniversities();

}