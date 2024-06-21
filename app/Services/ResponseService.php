<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ResponseService
{
    public function success_response($data = "", string $message = "The operation was successful"): JsonResponse
    {
        return response()->json([
            "success" => 'success',
            "message" => $message,
            "data" => $data
        ]);
    }

    public function error_response(string $message = "The operation failed"): JsonResponse
    {
        return response()->json([
            "success" => 'error',
            "message" => $message,
            "data" => ''
        ]);
    }

    public function unauthorized_response(): JsonResponse
    {
        return response()->json([
            "success" => 'error',
            "message" => 'You are not authorized to access this resource',
            "data" => ''
        ]);
    }

    public function delete_response(): JsonResponse
    {
        return response()->json([
            "success" => 'success',
            "message" => 'Deleted successfully',
        ]);
    }

    public function notFound_response(): JsonResponse
    {
        return response()->json([
            "success" => 'error',
            "message" => 'Not found',
        ]);
    }
}
