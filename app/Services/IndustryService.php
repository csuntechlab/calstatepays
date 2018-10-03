<?php

namespace App\Services;

use App\Contracts\IndustryContract;
use App\Models\NaicsTitle;
use App\Models\University;
use App\Models\UniversityMajor;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class IndustryService implements IndustryContract
{
    public function getAllIndustryNaicsTitles()
    {
        $allNaicsTitles = NaicsTitle::all();

        if($allNaicsTitles->isEmpty()){
            $message = 'There is no Naics Title data';
            throw new ModelNotFoundException($message,409);
        }

        $allNaicsTitles = $allNaicsTitles->map(function ($item, $key) {
            return [
                'naics_code' => $item['naics_code'],
                'title' => $item['naics_title'],
                'image' => asset($item['image'])
            ];
        });
        return $allNaicsTitles;
    }

    public function getIndustryPopulationByRank($hegis_code, $universityName)
    {
        University::where('id',$university_id)->where('opt_in',1)->firstOrFail();

        $university_major = UniversityMajor::with(['industryPathTypes' => function ($query) {
                $query->where('entry_status', 'FTF + FTT');
                $query->where('student_path', 1);
                }, 'industryPathTypes.population', 'industryPathTypes.naicsTitle', 'industryPathTypes.industryWage'])
                    ->where('hegis_code', $hegis_code)
                    ->where('university_id', $opt_in->id)
                    ->firstOrFail();

        $industry_populations = $university_major->industryPathTypes->sortByDesc('population.population_found')->values();
        $population_total = $this->getIndustryPopulationTotals($industry_populations);
        $industry_populations = $this->calculatePopulationPercentages($industry_populations, $population_total);
        return $industry_populations;
    }

    private function getIndustryPopulationTotals($industry_populations) {
        $total = 0;
        foreach($industry_populations as $pop) {
            if($pop->population->population_found != null){
                $total += $pop->population->population_found;
            }
        }
        return $total;
    }

    private function calculatePopulationPercentages($industry_populations, $population_total) {
        $final =  $industry_populations = $industry_populations
            ->map(function ($industry,$index = 0) use($population_total){
                $index++;
                if( ($industry->population->population_found != null) && ($population_total != null) ){
                    $percentage = round( ($industry->population->population_found/$population_total)*100, 0, PHP_ROUND_HALF_DOWN);
                }else{
                    $percentage = null;
                }
                return [
                    'title' => $industry->naicsTitle->naics_title,
                    'percentage' => $percentage,
                    'rank' => $index,
                    'image' => asset($industry->naicsTitle->image),
                    'industryWage' => $industry->industryWage->avg_annual_wage_5
                ];
            });
        return $final;
    }
}