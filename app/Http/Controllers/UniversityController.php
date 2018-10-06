<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Contracts\UniversityContract;

class UniversityController extends Controller
{

    protected $universityRetriever;

    public function __construct(UniversityContract $universityContract)
    {
        $this->universityRetriever = $universityContract;
    }

    public function getAllStudentPaths()
    {
        return $this->studentPathRetriever->getAllStudentPaths();
    }
    public function getAllUniversities() {
        $data = University::all()->toArray();
        return $data;
    }
}
