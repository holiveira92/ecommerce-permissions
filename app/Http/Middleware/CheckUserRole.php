<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        $isNotAllowed = false;
        $role = auth()->user()->roles->role;
        $url = url()->current();

        foreach ($role->permissions as $permission) {

            if (empty($permission->excluded_routes)) {
                continue;
            }

            $excludedItems = explode(",", $permission->excluded_routes);
            foreach($excludedItems as $item) {
                if (str_contains($url, $item)) {
                    $isNotAllowed = true;
                }
            }
        }

        if ($isNotAllowed) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/login');
        }

        return $next($request);
    }
}
