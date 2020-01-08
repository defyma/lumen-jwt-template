<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
     protected static $functions = null;

    /**
     * @param $token
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $data = [])
    {
        return response()->json([
            "meta" => [
                'success' => true,
                'message' => 'Berhasil Login'
            ],
            "data" => [
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60,
                'user' => $data
            ]
        ], 200);
    }

    /**
     * @param $data
     * @param int $status
     * @return MetaHelper|\Illuminate\Http\JsonResponse
     */
    protected function setData($data) {

        $responseData = [
            'data' => $data
        ];

        return self::setMeta($responseData);
    }

    protected static function setMeta($responseData) {
        if(self::$functions == null)
            self::$functions = new MetaHelper($responseData);

        return self::$functions;
    }
}
