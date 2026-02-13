<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $requiredRoles=null): Response
    {

        if(!auth()->check()){
            abort(403);
        }

        $user=auth()->user();
        $userRole=$user->role;

        $requiredRolesArray=explode(',', $requiredRoles);

        //accertamento ruolo
        if(in_array($userRole,$requiredRolesArray)){
            return $next($request);
        }
        //altrimenti
        abort(403);
    }
}
