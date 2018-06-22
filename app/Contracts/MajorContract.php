<?php

namespace App\Contracts;

interface MajorContract
{
    public function getAllHegisCodes(): array;

    public function getAllFieldOfStudies(): array;

    public function getMajorEarnings($hegis_code, $university_id): array;
}