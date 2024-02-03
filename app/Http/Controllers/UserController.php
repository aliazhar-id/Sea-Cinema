<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('dashboard.main.profile', [
      'title' => 'Profile',
      'posts' => []
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    $isProfileUpdated = false;

    $rules = [
      'password' => 'required|max:255|current_password',
      'new_password' => 'nullable|min:6|max:255|confirmed',
      'new_password_confirmation' => 'max:255',
    ];

    if ($request->name != $user->name) {
      $rules['name'] = 'required|min:3|max:100';
      $isProfileUpdated = true;
    }

    if ($request->username != $user->username) {
      $rules['username'] = 'required|alpha_dash|unique:users|min:3|max:15';
      $isProfileUpdated = true;
    }

    if ($request->email != $user->email) {
      $rules['email'] = 'required|email:dns|unique:users|max:30';
      $isProfileUpdated = true;
    }

    if ($request->file('image')) {
      $rules['image'] = 'image|file|max:2048';
      $isProfileUpdated = true;
    }

    $validatedData = $request->validate($rules);

    if ($request->new_password) {
      $validatedData['password'] = Hash::make($validatedData['new_password']);
      $isProfileUpdated = true;
    } else {
      unset($validatedData['password']);
    }

    if ($request->file('image')) {
      if ($user->image) {
        Storage::delete($user->image);
      }

      $image = Image::read($request->file('image'));
      $ratio = 1 / 1;

      if (intval($image->width() / $ratio > $image->height())) {
        $image->cover(intval($image->height() * $ratio), $image->height());
      } else {
        $image->cover($image->width(), intval($image->width() / $ratio));
      }

      $filePath = 'profile-images/' . uniqid() . uniqid() . '.jpg';
      $image->save(storage_path('app/public/' . $filePath));

      $validatedData['image'] = $filePath;
    }

    if (!$isProfileUpdated) {
      return back()->with('error', 'No profile changes detected!');
    }

    unset($validatedData['new_password']);
    unset($validatedData['new_password_confirmation']);

    User::where('id_user', $user->id_user)->update($validatedData);

    return back()->with('success', 'Profile updated successfully!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    //
  }
}
