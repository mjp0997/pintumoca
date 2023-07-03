<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidateOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $model_name): Response
    {
        $model = "App\\Models\\$model_name";
        
        $data = $model::with('user')->find($request->route('id'));
        
        $user = Auth::user();

        if (in_array($user->role->name, ['DEV', 'ADMIN'])) {
            return $next($request);
        }

        if (!isset($data)) {
            return redirect()->back();
        }

        if ($data->user->id != $user->id) {
            return redirect()->back();
        }

        return $next($request);
    }
}
