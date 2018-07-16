<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\StudentPathContract;

class StudentPathController extends Controller
{
    protected $studentPathRetriever;

    public function __construct(StudentPathContract $studentPathContract)
    {
        $this->studentPathRetriever = $studentPathContract;
    }

    public function getAllStudentPaths()
    {
        return $this->studentPathRetriever->getAllStudentPaths();
    }
}
