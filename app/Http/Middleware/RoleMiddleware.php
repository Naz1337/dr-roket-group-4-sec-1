<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Roles;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $roles = array_map('strtolower', $roles);
        $roles = array_map(function ($role) {
            return Roles::getEnumValue($role);
        }, $roles);
        if (!in_array(Auth::user()->user_type, $roles))
            return to_route('dashboard');
        return $next($request);
    }
}
