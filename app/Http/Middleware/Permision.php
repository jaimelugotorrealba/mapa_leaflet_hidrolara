<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Permision
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && ((isset(auth()->user()->userRole) && !is_null(auth()->user()->userRole) && (auth()->user()->userRole->role->name !== 'Visitante'))) && auth()->user()->user_type_id !== 3){
            return $next($request);
        }else{
            return response()->view('errors.404');
        }
    }
}
