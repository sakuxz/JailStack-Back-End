<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\User;
use JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $input = $request->only(['name', 'email', 'password']);
        $newUser = new User($input);
        $newUser->password = bcrypt($request->input('password'));
        $newUser->save();
        return [ 'success' => true, 'data' => [
            'user' => $newUser,
            'token' => JWTAuth::fromUser($newUser)
            ] ];
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 500);
        }
        $user = User::where('email', $request->input('email'))->first();
        // all good so return the token
        return response()->json(['success' => true, 'data'=> [ 'token' => $token, 'user' => $user ]]);
    }
}
