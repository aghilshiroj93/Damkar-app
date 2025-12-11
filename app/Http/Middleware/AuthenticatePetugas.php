<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticatePetugas
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->session()->has('petugas_id')) {
            $request->session()->put('url.intended', $request->fullUrl());
            return redirect()->route('login.form')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
