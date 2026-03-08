<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalhostOnly
{
    private const ALLOWED_IPS = ['127.0.0.1', '::1'];

    public function handle(Request $request, Closure $next): Response
    {
        if (!in_array($request->ip(), self::ALLOWED_IPS, true)) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
