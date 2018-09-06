<?php

namespace App\Contracts;

interface MajorContract
{
    public function getAllHegisCodes(): array;

    public function getAllFieldOfStudies(): array;

    public function getHegisCategories($fieldOfStudyId): array;
    
    public function getMajorEarnings($hegis_code, $university_id): array;

    public function getFREData($request);

    public function getAllUniversities();

}