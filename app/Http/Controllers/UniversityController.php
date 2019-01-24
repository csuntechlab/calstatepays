<?php

namespace App\Http\Controllers;

use App\Contracts\UniversityContract;
use Illuminate\Support\Facades\Cache;

class UniversityController extends Controller
{

    protected $universityRetriever = null;

    public function __construct(UniversityContract $universityContract)
    {
        $this->universityRetriever = $universityContract;
    }

    public function getAllUniversities()
    {
        $key = "universitysForCalStatePays";

        if (Cache::has($key)) {
            $data = Cache::get($key);
            return json_decode($data);
        }

        $data = $this->universityRetriever->getAllUniversities();

        $value = json_encode($data);
        Cache::forever($key, $value);

        return $data;
    }
}
