<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Collection;

class ExcelController extends Controller
{
    public function showImportExportView(){
        return view('importFile');
    }


    public function importFile(Request $request){
        if($request->hasFile('imported_file')){
            $path = $request->file('imported_file')->getRealPath();
            $data = \Excel::load($path)->get();
            dd($this->mapStudentPathDataFromCsv($data));
        } else{
            dd('The Request has no path');
        }
    }

    public function mapHegisDataFromCsv(Collection $data){
        $data = $data->map(function($row){
            return [
                'hegis_code' => $row['program_code'],
                'major' => $row['major'],
                'university' => $row['campus']
            ];
        });
        return $data;
    }

    public function mapUniversityDataFromCsv(Collection $data){
        $data = $data->map(function($row){
            return [
                'id' => $row['id'],
                'university' => $row['university_name']
            ];
        });
        return $data;
    }

    public function mapStudentPathDataFromCsv(Collection $data){
        $data = $data->map(function($row){
            return[
                'path_name' => $row['path']
            ];
        });
        return $data;
    }
}