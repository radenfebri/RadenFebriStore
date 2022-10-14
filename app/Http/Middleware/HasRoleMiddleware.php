<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HasRoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $roles = Role::get();
            if ($request->user()->hasAnyRole($roles)) {
                return $next($request);
            } else {
                abort(403);
            }
        }
        return $next($request);
    }
}
