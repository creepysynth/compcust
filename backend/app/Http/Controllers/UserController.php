<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Register a new user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|min:2|max:32',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8|max:32'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'image' => config('app.url') . '/images/users/img.png'
        ]);

        $response = [
            'message' => 'User registered.',
            'user' => $user
        ];

        return response($response, 201);
    }

    /**
     * Login user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if (! $user = User::where('email', $fields['email'])->first()) {
            return response([
                "message" => "Bad credentials.",
                "errors" => [
                    'email' => ["Couldn't find your account."]
                ]
            ], 422);
        }

        if (! Hash::check($fields['password'], $user->password)) {
            return response([
                "message" => "Bad credentials.",
                "errors" => [
                    'password' => ['Wrong password.']
                ]
            ], 422);
        }

        $token = $user->createToken('I39fC3cm405D')->plainTextToken;

        $response = [
            'message' => 'User logged in.',
            'user' => $user,
            'token' => $token
        ];

        return response($response);
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response(['message' => 'Logged out']);
    }
}
