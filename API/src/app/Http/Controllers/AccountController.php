<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class AccountController extends Controller
{
    public function login(Request $request)
    {
            $name = $request->get('name');
            $password = $request->get('password');
            $user = Account::where('name',$name)->first();
            $token = $user->token;
            if ($user && $password == $user->password) {
                return ['token' => $token, 'name' => $name];
            } else {
                return;
            }
    }

    public function register(Request $request)
    {
        Account::create($request->all());
    }

}
