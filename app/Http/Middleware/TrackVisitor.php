<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        // Hanya simpan jika bukan request dari admin panel
        if (!str_starts_with($request->path(), 'admin')) {
            DB::table('visitors')->insert([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'visited_at' => now(),
                'path' => $request->path(),
            ]);
        }

        return $next($request);
    }
}
