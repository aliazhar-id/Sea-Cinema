<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function index()
  {
    return view('auth.login', [
      'title' => 'Login'
    ]);
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email|max:255',
      'password' => 'required'
    ]);

    // $remember_me = $request->has('remember_me') ? true : false;

    if (Auth::attempt($credentials, true)) {
      $request->session()->regenerate();

      return redirect(route('home'));
    }

    return back()->withInput()->with('error', 'You have entered an invalid email or password!');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect(route('home'));
  }
}
