<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return JsonResponse
     */
    public function profile()
    {
        return $this->asJson([
            'success' => true,
            'message' => 'Data ditemukan',
            'data' => Auth::user()
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function allUsers()
    {
        return $this->asJson([
            'success' => true,
            'message' => 'Data ditemukan',
            'data' => User::all()
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return $this->asJson([
                'success' => true,
                'message' => 'Data ditemukan',
                'data' => $user
            ]);

        } catch (Exception $e) {

            return $this->asJson([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => []
            ], 404);

        }

    }

}
