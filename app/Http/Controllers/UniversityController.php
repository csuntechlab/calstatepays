<?php

namespace App\Http\Controllers;

use App\Contracts\UniversityContract;

class UniversityController extends Controller
{

    protected $universityRetriever = null;

    public function __construct(UniversityContract $universityContract)
    {
        $this->universityRetriever = $universityContract;
    }
    
    public function getAllUniversities() 
    {
        return $this->universityRetriever->getAllUniversities();
    }
}
