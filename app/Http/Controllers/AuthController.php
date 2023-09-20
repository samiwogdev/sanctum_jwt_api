<?php

namespace App\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return response()->json($user);
    }

    public function login(Request $request)
    {
        // Auth::attempt([
        // 'email' => $request->input('email'),
        // 'password' => $request->input('password')
        // ]);

        //Try to login a user with the provided credential
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'messsage' => 'Invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }
        //if login attenpt successful Get the logged in user details
        $user = Auth::user();
        $token = $user->createToken('sample_token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24);
        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }

    public function user()
    {
        //step 1: access user via bearer token in http header
        return Auth::user();
    }

    public function logout(){
        $cookie = Cookie::forget('jwt');
        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }
}
