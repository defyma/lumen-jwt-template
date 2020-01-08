<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);
            $user->save();

            $data = [];
            //return successful response
            return $this->setData($data)
                ->setMeta([
                    'success'=>true,
                    'message'=>'CREATED'
                ])
                ->json();

        } catch (Exception $e) {
            return $this->setData($e->getMessage())
                ->setMeta([
                    'success'=>false,
                    'message'=>'Fail'
                ])
                ->json();
        }
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            $data = [
                'dataaaa'
            ];
            $meta = [
                'success' => true
            ];

            return $this
                ->setData($data)
                ->setMeta($meta)
                ->setStatus(200)
                ->json();
        }

        return $this->respondWithToken($token, Auth::user());
//        return
    }


}
