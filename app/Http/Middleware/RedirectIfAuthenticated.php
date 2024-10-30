<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next){

        if ($request->is('admin/*') || $request->is('admin')) {
            if (Auth::guard('admin')->check()) {
                return redirect()->route("admin.home");
            }
        }

        if ($request->is('teacher/*') || $request->is('teacher')) {
            if (Auth::guard('teacher')->check()) {
                return redirect()->route("teacher.home");
            }
        }

        if ($request->is('student/*') || $request->is('student')) {
            if (Auth::guard('student')->check()) {
                return redirect()->route("student.home");
            }
        }



    
        return $next($request);
    }
}
