<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use Illuminate\Http\Request;

class TopUpController extends Controller
{
  public function index()
  {
    return view('movies.topup', [
      'title' => 'Top Up',
      'history' => TopUp::latest()->where('id_user', auth()->user()->id_user)->get()
    ]);
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'amount' => 'required|integer|min:10000',
      'proof_image' => 'required|image|max:2048'
    ]);

    $validatedData['id_user'] = auth()->user()->id_user;

    if ($request->file('proof_image')) {
      $validatedData['proof_image'] = $request->file('proof_image')->store('topup-proof');
    }

    TopUp::create($validatedData);

    return back()->with('success', 'Top up request has been sent, please wait for approval!');
  }
}
