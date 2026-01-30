<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $Auth = session()->get('_login');

        if ($Auth) {
            if ($Auth['role'] == $role) {
                return $next($request);
            } else {
                abort(403);
            }
        } else {
            abort(500);
        }
    }
}
