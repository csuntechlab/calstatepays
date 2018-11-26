<?php

namespace App\Services;

use App\Models\UniversityMajor;
use App\Models\University;
use App\Contracts\PfreContract;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PfreService implements PfreContract
{
  public function getFREData($request)
  {
    /**
     * ugly bad easy way to go from uni_name -> uni_id
     */
    $university_id = University::where('short_name', $request->university)->firstOrFail();

    $data = UniversityMajor::where('hegis_code', $request->major)
      ->where('university_id', $university_id->id)
      ->with(['studentBackground' => function ($query) use ($request) {
        $query->where('age_range_id', $request->age_range);
        $query->where('education_level', $request->education_level);
      }, 'studentBackground.investment' => function ($query) use ($request) {
        $query->where('annual_earnings_id', $request->annual_earnings);
        $query->where('annual_financial_aid_id', $request->financial_aid);
      }])->firstOrFail();

    $freData = $data->studentBackground->first();
    $freData = $freData->investment->first();
    if (empty($freData)) {
      $message = 'Investment not found';
      throw new ModelNotFoundException($message, 409);
    }
    $freData = $freData->toArray();
    return $freData;
  }
}