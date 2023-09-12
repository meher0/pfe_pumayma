<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{


    use AuthenticatesUsers;


    /* protected $redirectTo = RouteServiceProvider::HOME; */



    public function redirectTo(){

        if(Auth::user()->role == 'admin')
        {
            return 'list';
        }

        if(Auth::user()->role == 'invite')
        {
            return 'invite/home';
        }

        if(Auth::user()->role == 'visiteur')
        {
            return 'visiteur';
        }

        if(Auth::user()->role == 'ministere')
        {
            return 'ministere/index';
        }

        if(Auth::user()->role == 'unite')
        {
            return 'unite/home';
        }
    }



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
