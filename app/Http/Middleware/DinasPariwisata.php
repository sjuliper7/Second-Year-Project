<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DinasPariwisata
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->role != 'DinasPariwisata'){
                if(Auth::user()->role =='Owner'){
                    return redirect('owner');
                }else if(Auth::user()->role=='Customer'){
                    return redirect('');
                }else{
                    return redirect('/home');
                }
            }
        }
        return $next($request);
    }
}
