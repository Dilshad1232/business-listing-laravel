<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | Check Login
        |--------------------------------------------------------------------------
        */

        if (!auth()->check()) {

            return redirect()
                ->route('login')
                ->with('error', 'Please login first.');
        }


        /*
        |--------------------------------------------------------------------------
        | Check User Role
        |--------------------------------------------------------------------------
        */

        if (auth()->user()->role !== 'user') {

            return redirect()
                ->route('admin.dashboard')
                ->with(
                    'error',
                    'You are not authorized to access the user dashboard.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Allow User
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}
