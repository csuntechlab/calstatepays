<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentPath;

class StudentPathController extends Controller
{
    public function getAllStudentPaths()
    {
        $allStudentPaths = StudentPath::all()->map(function ($path){
            return [
                'id'   => $path['id'],
                'name' => $path['path_name']
            ];
        });
        return $allStudentPaths->toArray();
    }
}
