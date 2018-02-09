<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MajorPath;


class AggregateDataController extends Controller
{
    public function getAverageIncomeByStudentPath(){
        $paths = MajorPath::where('student_path',1)
            ->with('majorPathWage')
            ->get();
        $averages=[];
        foreach ($paths as $path){
            array_push($averages, $path->majorPathWage->avg_annual_wage);
        }
        $bachelors_degree_avg = array_sum($averages)/count($averages);

        $paths = MajorPath::where('student_path',2)
            ->with('majorPathWage')
            ->get();
        $averages=[];
        foreach ($paths as $path){
            array_push($averages, $path->majorPathWage->avg_annual_wage);
        }
        $some_college_avg = array_sum($averages)/count($averages);

        $paths = MajorPath::where('student_path',3)
            ->with('majorPathWage')
            ->get();
        $averages=[];
        foreach ($paths as $path){
            array_push($averages, $path->majorPathWage->avg_annual_wage);
        }
        $master_avg = array_sum($averages)/count($averages);
        $averages = [
            'some_college_avg' => $some_college_avg,
            'bachelors_avg' => $bachelors_degree_avg,
            'masters_avg' => $master_avg
        ];
        return ($averages);
    }
}
