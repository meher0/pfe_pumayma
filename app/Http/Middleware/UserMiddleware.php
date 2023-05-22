<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\models\User;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        /************************* middleware confirme | refuser  ******/
       if (Auth::check() && Auth::user()->etat)
       {
           $banned = Auth::user()->etat == "0";
           Auth::logout();

            if($banned == 0)
            {
                $message = 'لقد تم انشاء الحساب .انتظر التفعيل على البريد الالكتروني ';
            }

            return redirect('login')->with('status',$message);

       }
        if (Auth::check())
       {
           $expiresAt = Carbon::now()->addMinutes(1);
           Cache::put('user-is-online' .Auth::user()->id, true, $expiresAt);
       }
        return $next($request);
    }
}
