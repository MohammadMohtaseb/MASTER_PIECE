<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        if (!$request->expectsJson()) {

            if ($request->is('admin/*') || $request->is('admin')) {
                if (!Auth::guard('admin')->check()) {
                    return route('admin.login');
                }
            }
            if ($request->is('teacher/*') || $request->is('teacher')) {
                if (!Auth::guard('teacher')->check()) {
                    return route('teacher.login');
                }
            }
            if ($request->is('student/*') || $request->is('student')) {
                if (!Auth::guard('student')->check()) {
                    return route('student.login');
                }
            }
            if ($request->is('parent/*') || $request->is('parent')) {
                if (!Auth::guard('parent')->check()) {
                    return route('parent.login');
                }
            }
        }
    }
}
