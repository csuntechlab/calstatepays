<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;

class UniversityController extends Controller
{
    public function getAllUniversities()
    {
        /*$universities = University::all();*/
        $universities = University::where('id',"70")->first();
        return [0 => $universities];
    }
}
