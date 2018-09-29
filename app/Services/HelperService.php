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

class HelperService 
{
  public function checkOptIn($university_id)
  {
    return "this works";
    dd($university_id);
      University::where('id',$university_id)->where('opt_in',1)->firstOrFail();
  }
}