<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class PelangganCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $pelanggans = Session::get('pelanggans');

        if($pelanggans){
            return $next($request);
        }

        return redirect()->route('home.login');
    }
}
