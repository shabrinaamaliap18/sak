<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     $roles = $this->CekRoute($request->route());

    //     if($request->user()->hasRole($roles) || !$roles)
    //     {
    //         return $next($request);
    //     }
    //     return abort(503, 'Anda tidak memiliki hak akses');
    // }

    // private function CekRoute($route)
    // {
    //     $actions = $route->getAction();
    //     return isset($actions['roles']) ? $actions['roles'] : null;
    // }

    // public function handle($request, Closure $next, $level_user_id)
    // {
    //     if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
    //         return redirect('masuk');

    //     $user = Auth::user();

    //     if ($user->level_user_id)
    //         return $next($request);

    //     foreach ($level_user_id as $level_user_id) {
    //         // Check if user has the role This check will depend on how your roles are set up
    //         if ($user->($user = $level_user_id))
    //             return $next($request);
    //     }

    //     return redirect('masuk');
    // }
}