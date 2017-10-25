<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Customer
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
            if(Auth::user()->role !='Customer'){
                if(Auth::user()->role == 'Owner'){
                    return redirect('owner');
                }elseif(Auth::user()->role=='DinasPariwisata'){
                    return redirect('/home');
                }else{
                    return redirect('');
                }
            }
        }else{
            return redirect('');
        }
        return $next($request);
    }
}
