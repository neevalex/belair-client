<?php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureClientRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return redirect()->route('client.login');
        }

        if (auth()->user()->role !== 'client') {
            abort(403, 'This area is restricted to client users.');
        }

        return $next($request);
    }
}