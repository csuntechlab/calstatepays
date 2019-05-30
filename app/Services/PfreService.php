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
            ->where('major', urldecode($request->major))
            ->where('in_school_earning', $request->in_school_earning)
            ->first();

        if (empty($data)) {
            return ['pfre' => 'No data.'];
        }
        $data = number_format((float)$data[$request->financial_aid], 0, '.', '') . "%";
        $data = [
            'pfre' => $data
        ];

        return $data;
    }
}
