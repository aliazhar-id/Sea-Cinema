<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function index()
  {
    return view('auth.register', [
      'title' => 'Register'
    ]);
  }

  public function register(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|min:3|max:100',
      'username' => 'required|alpha_dash|unique:users|min:3|max:15',
      'password' => 'required|min:6|max:255|confirmed',
      'password_confirmation' => 'required|max:50',
      'email' => 'required|email:dns|unique:users|max:30',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);
    $validatedData['username'] = strtolower($validatedData['username']);

    User::create($validatedData);

    return redirect(route('auth.login'))->with('success', 'Your account has been registered successfully. Please log in!');
  }
}
