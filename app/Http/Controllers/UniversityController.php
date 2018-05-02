<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;

class UniversityController extends Controller
{
    public function getAllUniversities()
    {
        $universities = University::all();
        return $universities;
    }
}
