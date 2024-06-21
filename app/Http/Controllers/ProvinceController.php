<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Spatie\FlareClient\Api;

class ProvinceController extends Controller
{
    // Provinces index
    public function index()
    {
        $provinces = Province::all();
        return $this->responseService->success_response($provinces);
    }
}
