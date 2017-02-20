<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $actions = $request->route()->getAction();
        $roles = isset($actions['role']) ? $actions['role'] : null;
        //var_dump(auth()->user()->hasAnyRole($roles));
        if (auth()->user()->hasAnyRole($roles)) {
            return $next($request);
        }

        return redirect('/login');
    }
}
