<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use Illuminate\Http\Request;

class DashboardTopUpVerificationController extends Controller
{
  public function index()
  {
    return view('dashboard.page.verification.topup', [
      'title' => 'Top Up Verification',
      'pending' => TopUp::oldest()->where('status', 'pending')->get(),
      'history' => TopUp::latest()->whereNot('status', 'pending')->get(),
    ]);
  }
}
