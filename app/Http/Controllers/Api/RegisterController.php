<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller {
    use RegistersUsers;

    public function register(Request $request) {

        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return response([
                "message" => "Can't Create User", 
                "status_code" => 404,
            ]);
        }

        $user = $this->create($request->all());

        if ($user->save()) {

            $token = JWTAuth::fromUser($user);

            return response([
                "token" => $token,
                "message" => "Success",
                "status_code" => 201,
            ]);
        } else {
            return response([
                "message" => "Create User Failed", 
                "status_code" => 404,
            ]);
        }
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    protected function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}