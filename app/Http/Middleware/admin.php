<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class admin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (!auth()->check()) {
      return redirect(route('auth.login'));
    }

    if (!in_array(auth()->user()->role, ['admin', 'superadmin'])) {
      abort(403);
    }

    return $next($request);
  }
}
