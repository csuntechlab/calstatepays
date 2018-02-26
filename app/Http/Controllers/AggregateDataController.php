<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MajorPath;
use App\Models\IndustryPathType;
use App\Models\IndustryWage;
use App\Models\NaicsTitle;

class AggregateDataController extends Controller
{
    public function getAverageIncomeByStudentPath(){
        $paths = MajorPath::
            with('majorPathWage')->get()
            ->groupBy('student_path');
        foreach ($paths as $path_number => $path) {
        }

        $averages=[
            '1'=>['2'=>[123],'5'=>[],'10'=>[]],
            '2'=>['2'=>[321],'5'=>[],'10'=>[]],
            '3'=>['2'=>[213],'5'=>[],'10'=>[]]
        ];
        foreach ($paths as $path_number => $path){
            foreach($path as $wage){
                array_push($averages[$path_number][$path[$path_number]['years']], $wage->majorPathWage->avg_annual_wage);
            }
            $averages[$path_number][$path->year] = array_sum($averages[$path_number])/count($averages[$path_number]);

        }
        dd($averages);
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

    public function getAverageIncomeByIndustry()
    {
		$naicsTitles =  NaicsTitle::with('industryWage')->get()->keyBy('naics_code');
      foreach ($naicsTitles as $industry) {
        $industryWages = $industry->industryWage->toArray();
        $avg_annual_wage_5 = array_column( $industryWages ,'avg_annual_wage_5');
        $avg_annual_wage_10 = array_column( $industryWages ,'avg_annual_wage_10');
        $industry['avg_annual_wage_5'] = array_sum($avg_annual_wage_5) / count($avg_annual_wage_5);
        $industry['avg_annual_wage_10'] = array_sum($avg_annual_wage_10) / count($avg_annual_wage_10);
      }
		return $naicsTitles;
    }

    //This function will return a view of //https://drive.google.com/drive/u/1/folders/1zSyC6k31otujgetuOGcRYRpHJ_Z5KS_b
    public function getAggregateCollegesPFRE(Request $request){
        //Request will hold POST for $major, $age, $educationLevel, yearsCommCollege, $annualEarnings
        //Given the above variables, query database for:
        //Cost of Degree, Estimated 4-year income, ROI
        //This function returns a view and the above data
    }
}
