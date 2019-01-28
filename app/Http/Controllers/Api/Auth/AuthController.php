<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Model\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request) {
        $user = User::where('email', $request->email)->orWhere('name', $request->email)->first();

        if ($user && Hash::check($request->get('password'), $user->password)) {
            $token = JWTAuth::fromUser($user);
            return $this->sendLoginResponse($request, $token);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function sendLoginResponse(Request $request, $token) {
        $this->clearLoginAttempts($request);

        return $this->authenticated($token);
    }

    public function authenticated($token) {
        return response([
            'token' => $token,
            'status_code' => 200,
            'message' => 'User Authenticated',
        ])->header('Authorization', $token);
    }

    public function sendFailedLoginResponse() {
        return response([
            'status_code' => 401,
            'message' => 'Login Failed',
        ], 401);
    }

    public function user(Request $request) {
        $user = User::find($this->guard()->user()->id);

        if (!isset($user)) {
            return response([
                'status_code' => 404,
                'message' => 'User Not Found'
            ], 404);
        }
        else {
            return response([
                'status_code' => 200,
                'data' => $user
            ]);
        }
    }

    public function refresh() {
        return response([
            'status' => 'success'
        ]);
    }

    public function logout() {
        $this->guard()->logout();
        return response([
            'status_code' => 200,
            'message' => 'Logged out Successfully',
        ]);
    }
}