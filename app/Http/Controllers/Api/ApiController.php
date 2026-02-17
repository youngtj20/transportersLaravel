<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

abstract class ApiController extends Controller
{
    protected function success($data = null, $message = '', $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    protected function error($message = 'Something went wrong', $statusCode = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $statusCode);
    }
}