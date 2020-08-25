<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('login.login');
    }

    public function welcome()
    {
        return view('welcome');
    }
    public function postLogin(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('user');
        } else {
            return redirect()->back()->with('status', 'Email or Password incorrect');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('user-login');
    }
}
