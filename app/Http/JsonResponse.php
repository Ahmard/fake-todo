<?php

namespace App\Http;

use Illuminate\Http\JsonResponse as LaravelJsonResponse;

class JsonResponse
{
    public static function success($data, int $status = 200, array $headers = []): LaravelJsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'status' => 200,
                'data' => $data,
            ],
            $status,
            $headers
        );
    }

    public static function error($data, int $status = 500, array $headers = []): LaravelJsonResponse
    {
        return response()->json(
            [
                'success' => false,
                'status' => $status,
                'data' => $data,
            ],
            $status,
            $headers
        );
    }
}
