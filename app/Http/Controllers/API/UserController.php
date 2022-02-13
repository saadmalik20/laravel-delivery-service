<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends APIController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function authenticate(Request $request) : JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;
            $success['type'] = $user->type;

            return $this->sendResponse($success, 'User login successfully.');
        }

        return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
        }
        return $this->sendResponse(true, 'Logout successfully.');
    }

}
