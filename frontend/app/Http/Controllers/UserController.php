<?php

namespace App\Http\Controllers;

use App\Http\Backend\Api;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request, Api $api)
    {
        $response = $api->post('login', $request->all())->send();

        $token = cookie(config('app.token_name'), $response->object()->token);
        $user = cookie('user', json_encode($response->object()->user));

        return redirect(route('homepage'))->withCookies([$token, $user]);
    }

    public function logout(Api $api)
    {
        $api->get('logout')->send();

        return redirect(route('user.login.form'))
                   ->withoutCookie(config('app.token_name'))
                   ->withoutCookie('user');
    }

    public function registerForm()
    {
        return view('user.register');
    }

    public function register(Request $request, Api $api)
    {
        $api->post('register', $request->all())->send();

        return redirect(route('user.login.form'))
                   ->with('message-success', "User registered successfully. You can log in now.");
    }
}
