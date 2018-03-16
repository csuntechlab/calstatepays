<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use StudentPath;

class StudentPathController extends Controller
{
    public function getAllStudentPaths()
    {
        $allStudentPaths = StudentPath::all()->map(function ($path){
            return [
                'id'   => $path['path'],
                'name' => $path['path_name']
            ];
        });
        return $allStudentPaths->toArray();
    }
}
