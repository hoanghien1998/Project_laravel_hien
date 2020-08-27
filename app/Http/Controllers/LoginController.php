<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Auth;

/**
 * Class LoginController normal login
 *
 * @package App\Http\Controllers
 */
class LoginController extends Controller
{
    /**
     * Show login page
     *
     * @return Application|Factory|RedirectResponse|Redirector|View|mixed|void
     */
    public function getLogin()
    {
        return view('login.login');
    }

    /**
     * Show welcome page
     *
     * @return Application|Factory|View|mixed
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Handle login and redirect after login
     *
     * @param LoginRequest $request form data
     *
     * @return Application|RedirectResponse|Redirector|void
     */
    public function postLogin(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('user');
        } else {
            return redirect()->back()->with('status', 'Email or Password incorrect');
        }
    }

    /**
     * Logout account
     *
     * @return Application|RedirectResponse|Redirector|void
     */
    public function logout()
    {
        Auth::logout();
        return redirect('user-login');
    }
}
