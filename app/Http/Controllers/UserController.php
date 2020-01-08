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
        return $this->setData(Auth::user())
            ->setMeta([
                'success' => true,
                'message' => 'Data ditemukan'
            ])->json();
    }

    /**
     * @return JsonResponse
     */
    public function allUsers()
    {
        return $this->setData(User::all())
            ->setMeta([
                'success' => true,
                'message' => 'Data ditemukan'
            ])->json();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return $this->setData($user)
                ->setMeta([
                    'success' => true,
                    'message' => 'Data ditemukan'
                ])->json();

        } catch (Exception $e) {

            return $this->setData([])
                ->setMeta([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ])
                ->json();

        }

    }

}
