<?php

namespace App\Services;

use App\Models\Pfre;
use App\Models\University;
use App\Contracts\PfreContract;
use App\Models\UniversityMajor;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PfreService implements PfreContract
{
    public function getFREData($request)
    {
        $data = Pfre::where('entry_status', $request->entry_status)
                    ->where('major', $request->major)
                    ->where('in_school_earning', $request->in_school_earning)
                    ->firstOrFail();

        if (empty($data)) {
            $message = 'FRE data not found';
            new ModelNotFoundException($message, 409);
        }

        $data = $this->selectDataWithFinancialAid($data, $request->financial_aid);
        $data = number_format((float)$data, 2, '.', '') . "%";
        $data = [
            'pfre' => $data
        ];

        return $data;
    }

    private function selectDataWithFinancialAid($data, $fin_aid)
    {
        switch($fin_aid){
            case 1:
                return $data['fin_aid_0'];
            case 2:
                return $data['fin_aid_3000'];
            default:
                return $data['fin_aid_10000'];
        }
    }
}