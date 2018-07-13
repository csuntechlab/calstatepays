<?php 

namespace App\Services;

use App\Contracts\StudentPathContract;
use App\Models\StudentPath;

class StudentPathService implements StudentPathContract 
{
    public function getAllStudentPaths(): array
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