<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'type' => 'required|in:admin,teacher,parent,student',
        ]);

        $credentials = $request->only('email', 'password');

        // Determine the guard based on the selected user type
        $guard = $request->type;

        if (Auth::guard($guard)->attempt($credentials)) {
            if($guard == 'admin')
            {
                return response()->json(['success' => true, 'redirect_url' => route("admin.home")]);
            }
            if($guard == 'teacher')
            {
                return response()->json(['success' => true, 'redirect_url' => route("teacher.home")]);
            }
            if($guard == 'parent')
            {
                return response()->json(['success' => true, 'redirect_url' => route("parent.home")]);
            }
            if($guard == 'student')
            {
                return response()->json(['success' => true, 'redirect_url' => route("student.home")]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Invalid credentials']);
    }
}
