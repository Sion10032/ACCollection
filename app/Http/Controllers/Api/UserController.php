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
        $user = User::find(Auth::user()->id);
        return response([
                'status_code' => 200,
                'user_data' => $user
            ]);
    }
}
