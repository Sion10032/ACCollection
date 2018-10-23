<?php

namespace App\Http\Controllers\Api;

use App\Model\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return User::all();
    }

    public function show(Request $request, $uid)
    {
        $user = User::find($uid);
        if (!isset($user)) {
            return response([
                'status_code' => 404,
                'message' => 'User Not Found'
            ], 404);
        }
        else {
            return response([
                'status_code' => 200,
                'user_data' => $user
            ]);
        }
    }
}
