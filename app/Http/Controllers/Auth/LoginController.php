<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\Auth\Facade\UserEmailIsValid;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    /**
     * Handle a login view request
     *
     * @return Response
     */
    public function login()
    {
        return view('auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            "name" => "alpha|required",
            "email" => "email|required"
        ]);

        $user = User::updateOrCreate([
            "email" => $request->email,
        ], [
            "name" => $request->name,
            "api_token" => Str::random(60)
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Handle a logout request
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
