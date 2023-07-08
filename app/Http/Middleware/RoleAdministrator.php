<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if(!Auth::guard('web')->check()){
            return redirect()->route('admin.entry');
        }

        $user = Auth::guard('web')->user();
        if($user->isAdmin()){
            return $next($request);
        }

        return redirect()->route('admin.entry');
        /*if ($user && in_array($user->role, $roles)) {
            return $next($request);
        }*/
    }
}
