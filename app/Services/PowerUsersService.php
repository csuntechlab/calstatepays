<?php

namespace App\Services;

use App\Models\University;
use App\Models\PowerUserImage;
use App\Contracts\PowerUsersContract;
use App\Models\PowerUsersData;

class PowerUsersService implements PowerUsersContract
{
    public function getPowerUserDataByUniversity($university, $path_id)
    {
        $university = University::where('short_name', $university)
            ->where('opt_in', 1)
            ->firstOrFail();

        $universityId = $university->id;

        $data = PowerUsersData::where('university_id', $universityId)->where('path_id', $path_id)->firstOrFail();
        $test['iframe_string'] = $data['iframe_string'];

        return $test;
    }

    /** The card images for the landing page of the power users. */
    public function getPowerUsersCardImages(){
        $university_card_images = PowerUserImage::all();
        $setImages = $university_card_images = $university_card_images->map(function($university_card){
            return [
                "card_image" => asset($university_card->card_image),
                "university" => $university_card->university,
                "opt_in" => $university_card->opt_in
            ];
        });
        if ($setImages->isEmpty()) {
            $message = 'No image data';
            throw new ModelNotFoundException($message, 409);
        }
        return $setImages;
    }
}