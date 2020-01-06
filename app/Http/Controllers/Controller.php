<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    /**
     * @param $token
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $data = [])
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => $data
        ], 200);
    }

    /**
     * @param $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function asJson($data, $status = 200) {
        return response()->json($data, $status);
    }
}
