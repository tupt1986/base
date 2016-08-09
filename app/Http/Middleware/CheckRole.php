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
        if($request->user()===null){
            return response('Khong co quyen truy cap', 401);
        }
        $acction = $request->route()->getAction();
        $roles = isset($acction['roles']) ? $acction['roles'] : null;

        if ($request->user()->hasAnyRole($roles) || !$roles){
            return $next($request);
        }
        return response("Khong co quyen truy cap111", 401);
    }
}
