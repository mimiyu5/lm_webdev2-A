<?php

namespace App\Http\Controllers;

use view;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     // Show the login form
     public function showLoginForm()
     {
         return view('login');
     }
 
     // Handle login logic
     public function login(Request $request)
     {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('');
        }
    
        // Return back with error message
        return back()->withErrors([
            'login_failed' => 'The provided credentials do not match our records.'
        ]);
     }
 
     // Show the registration form
     public function showRegistrationForm()
     {
         return view('register');
     }
 
     // Handle registration logic
     public function register(Request $request)
     {
         // Validate the incoming request
         $validated = $request->validate([
             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'email', 'unique:users,email'],
             'password' => ['required','min:3', 'confirmed'],
         ]);
 
         // Create the new user
         $user = User::create([
             'name' => $validated['name'],
             'email' => $validated['email'],
             'password' => Hash::make($validated['password']),
         ]);
 
         // Log in the new user
         Auth::login($user);
 
         // Redirect to dashboard
         return redirect()->intended('book.index');
     }
 
     // Handle logout logic
     public function logout(Request $request)
     {
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();
 
         return redirect('login');
     }
}
