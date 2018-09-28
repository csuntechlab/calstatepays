<?php

namespace App\Services;

use App\Models\FieldOfStudy;
use App\Models\HEGISCode;
use App\Models\MajorPath;
use App\Models\UniversityMajor;
use App\Models\University;
use App\Contracts\MajorContract;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MajorService implements MajorContract
{
    public function optIn()
    {
      
    }
}