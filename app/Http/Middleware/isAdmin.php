<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role == 'admin' && session('role') === 'admin') {
            return $next($request);
        } else {
            return abort(403, 'Unauthorized');
        }
        // abort(403, 'Unauthorized');
    }
}
