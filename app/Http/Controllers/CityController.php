<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends ApiController
{
    public function index(Request $request)
    {
        $cities = new City();
        $cities = $cities->all();
        if ($request->province == 'Tehran')
        {
            $cities = $cities->where('province_id', 1);
        }
        if ($request->province == 'Esfehan')
        {
            $cities = $cities->where('province_id', 2);
        }
        if ($request->province == 'Khorasan Razavi')
        {
            $cities = $cities->where('province_id', 3);
        }
        if ($request->province == 'Mazandaran')
        {
            $cities = $cities->where('province_id', 4);
        }
        if ($request->province == 'Yazd')
        {
            $cities = $cities->where('province_id', 5);
        }
        if ($request->province == 'Fars')
        {
            $cities = $cities->where('province_id', 6);
        }
        if ($request->province == 'Alborz')
        {
            $cities = $cities->where('province_id', 7);
        }
        return $this->success_response($cities);
    }
}
