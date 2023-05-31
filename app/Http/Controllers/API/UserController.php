<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginUser(Request $request)
    {
        $input = $request->all();
        Auth::attempt($input);

        $user = Auth::user();

        $token = $user->createToken('example')->accessToken;
        return response()->json([
            "token" =>  $token,
            "status" => 200
        ]);
    }

    public function getUserDetail()
    {
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            return response()->json([
                "data" =>  $user,
                "status" => 200
            ]);
        }
        return response()->json([
            "data" =>  'Unauthenticated',
            "status" => 401
        ]);
    }


    public function userLogout()
    {
        $accessToken = Auth::guard('api')->user()->token();
        \DB::table('oauth_refresh_tokens')
        ->where('access_token_id', $accessToken)
        ->update(['revoked' => true]);
        $accessToken->revoke();

        return response()->json([
            "data" =>  'Unauthenticated',
            "message"=> 'User logout successfully',
            "status" => 200
        ]);
    }
}
