<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    public function _generate_response($response_body, $response_code) : JsonResponse
    {
        return response()->json($response_body, $response_code);
    }
}
