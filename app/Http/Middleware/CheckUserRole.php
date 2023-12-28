<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        $isNotAllowed = false;
        $role = auth()->user()->roles->role;
        $url = url()->current();

        foreach ($role->permissions as $permission) {
            if (!empty($permission->excluded_routes) && str_contains($url, $permission->excluded_routes)) {
                $isNotAllowed = true;
            }
        }

        if ($isNotAllowed) {
            return redirect('/')->with('error', 'You do not have permission to access this page');
        }

        return $next($request);
    }
}
