<?php

namespace App\Services;

use App\Models\University;
use App\Models\PowerUserImage;
use App\Contracts\PowerUsersContract;
use App\Models\PowerUsersData;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PowerUsersService implements PowerUsersContract
{
    public function getPowerUserDataByUniversity($university, $path_id)
    {
        $university = University::where('short_name', $university)
            ->where('opt_in', 1)
            ->firstOrFail();

        $universityId = $university->id;

        $powerUserData = PowerUsersData::where('university_id', $universityId)->where('path_id', $path_id)->where('opt_in', 1)->firstOrFail();


        $iFrameString['iframe_string'] = $powerUserData['iframe_string'];

        return $iFrameString;
    }


    public function getTableauOptInUniversityData()
    {

        $powerUserData = PowerUsersData::where('opt_in', 1)->get();

        if ($powerUserData->isEmpty()) {
            $message = 'No Power User Data';
            throw new ModelNotFoundException($message, 409);
        }

        return $powerUserData->groupBy('university_id');
    }

    /** The card images for the landing page of the power users. */
    public function getPowerUsersCardImages(){
        $university_card_images = PowerUserImage::all();
    
        $university_card_images = $this->mappPowerUsersCardImages($university_card_images);

        if ($university_card_images->isEmpty()) {
            $message = 'No image data';
            throw new ModelNotFoundException($message, 409);
        }

        return $university_card_images;
    }

    public function mappPowerUsersCardImages($university_card_images){
       
        $setImages = $university_card_images->map(function($university_card){
            return [
                "id" => $university_card->id,
                "card_image" => asset($university_card->card_image),
                "university" => $university_card->university,
                "opt_in" => $university_card->opt_in
            ];
        });

        return $setImages;
    }
}