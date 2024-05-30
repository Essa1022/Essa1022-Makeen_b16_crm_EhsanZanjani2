<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\InteractsWithMedia;

class ApiController extends Controller
{

    use InteractsWithMedia;

    public function success_response($data = "", string $message = "The operation was successfull")
    {
        return response()->json([
            "success" => 'success',
            "message" => $message,
            "data" => $data
        ]);
    }

    public function error_response(string $message = "The operation failed")
    {
        return response()->json([
            "success" => 'error',
            "message" => $message,
            "data" => ''
        ]);
    }

    public function unauthorized_response()
    {
        return response()->json([
            "success" => 'error',
            "message" => 'You are not authorized to access this resource',
            "data" => ''
        ]);
    }

    public function delete_response()
    {
        return response()->json([
            "success" => 'success',
            "message" => 'Deleted successfully',
        ]);
    }

    public function notFound_response()
    {
        return response()->json([
            "success" => 'error',
            "message" => 'Not found',
        ]);
    }
}
