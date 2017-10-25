<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Owner
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
            if(Auth::user()->role != 'Owner'){
                redirect('login');
                if(Auth::user()->role == 'Customer'){
                    return redirect('');
                }elseif(Auth::user()->role == 'DinasPariwisata'){
                    return redirect('admin');
                }else{
                    return redirect('owner');
                }
            }
        }
        return $next($request);
    }
}
