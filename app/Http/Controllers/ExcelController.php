<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Excel;

class ExcelController extends Controller
{
    public function showImportExportView(){
        return view('importFile');
    }

    public function importFile(Request $request){
        if($request->hasFile('imported_file')){
            $path = $request->file('imported_file')->getRealPath();
            $data = \Excel::load($path)->get();
        } else{
            dd('The Request has no path');
        }
    }

    public function mapHegisDataFromCsv(){
        $hegisData = [
            'Campus' => '',
            'Major' => '',
            'Hegis_Code' => '',
        ];
    }
}