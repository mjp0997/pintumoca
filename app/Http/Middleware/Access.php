<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$types): Response
    {
        $user = Auth::user();

        if ($user->role->name == 'DEV') {
            return $next($request);
        }

        $roles = collect($types)->map(function ($value) {
            return strtolower($value);
        })->toArray();

        if (!in_array(strtolower($user->role->name), $roles)) {
            return redirect()->route('home');
        }
        
        return $next($request);
    }
}
