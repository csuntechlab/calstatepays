<?php

namespace App\Contracts;

interface PowerUsersContract
{
    public function getPowerUserDataByUniversity($university, $path_id);

    public function getTableauOptInUniversityData();
}