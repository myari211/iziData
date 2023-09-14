<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => ['required', 'unique:users', 'email'],
            "password" => ['required', 'min:8'],
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "messages" => $validator->messages()->all(),
            ], 401);
        }

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        return response()->json([
            "status" => true,
            "messages" => "Register Success",
            "user_id" => $user->id,
        ], 200);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => ['required', 'email'],
            "password" => ['required', 'min:8'],
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "messages" => $validator->messages()->all(),
            ], 401);
        }

        if(Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            $success = Auth::user()->createToken('iziData')->accessToken;
            $token = 'Bearer '.$success;


            return response()->json([
                "status" => true,
                "token" => $token,
            ], 200);
        }

        else

        {
            return response()->json([
                "status" => false,
                "messages" => "Email and Password missmatch",
            ], 401);
        }
    }
}
