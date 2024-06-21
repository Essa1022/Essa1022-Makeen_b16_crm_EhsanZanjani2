<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $cities = new City();
        $cities = $cities->all();
        match ($request->province)
        {
            'Tehran' => $cities = $cities->where('province_id', 1),
            'Esfehan' => $cities = $cities->where('province_id', 2),
            'Khorasan Razavi' => $cities = $cities->where('province_id', 3),
            'Mazandaran' => $cities = $cities->where('province_id', 4),
            'Yazd' => $cities = $cities->where('province_id', 5),
            'Fars' => $cities = $cities->where('province_id', 6),
            'Alborz' => $cities = $cities->where('province_id', 7),
            default => $cities,
        };
        return $this->responseService->success_response($cities);
    }
}
