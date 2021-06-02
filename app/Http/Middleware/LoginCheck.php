<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $level)
    {
        if (!Auth::check()){
            return redirect()->route('backend.login')->with('error',"Error: Harap login dahulu");
        }
        
        $user = Auth::user();

        if($user->level == $level){
            return $next($request);
        }

        return redirect()->route('error')->withErrors(['type' => '401','message' => 'Level akses tidak sesuai']);
    }
}