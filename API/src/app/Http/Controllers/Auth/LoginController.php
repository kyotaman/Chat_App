<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//追加↓
use Illuminate\Http\Request;
use App\Account;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

        //追加
    protected function authenticated(Request $request, $user)
    {
            $email = request()->get("email");
            $password = request()->get("password");
            $user = Account::where("name",$user)->first();
            if ($user && $password == $user->password) {
            $token = str_random();
            $user->token = $token;
            $user->save();
            return [
            "token" => $token,
            "user" => $user
            ];
        }
    }
}
