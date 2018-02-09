<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MajorPath;


class AggregateDataController extends Controller
{
    public function getAverageIncomeByStudentPath(){
        $paths = MajorPath::
            with('majorPathWage')
            ->get()->groupBy('student_path');
        $averages=['1'=>[],'2'=>[],'3'=>[]];
        foreach ($paths as $path_number => $path){
            foreach($path as $wage){
                array_push($averages[$path_number], $wage->majorPathWage->avg_annual_wage);
            }
            $averages[$path_number] = array_sum($averages[$path_number])/count($averages[$path_number]);

        }

        $some_college_avg       = $averages[1];
        $bachelors_degree_avg   = $averages[2];
        $master_avg             = $averages[3];

        $averages = [
            'some_college_avg' => $some_college_avg,
            'bachelors_avg' => $bachelors_degree_avg,
            'masters_avg' => $master_avg
        ];
        return ($averages);
    }
}
