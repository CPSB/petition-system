<?php

namespace ActivismeBE\Http\Middleware;

use Auth;
use Closure;

/**
 * Class RoleMiddleware
 *
 * If you building a project don't edit this file. Because this file will be overwritten.
 * When we are updated our project skeleton. And if you found an issue in this controller
 * Use the following links.
 *
 * @url https://github.com/CPSB/Skeleton-project
 * @url https://github.com/CPSB/Skeleton-project/issues
 */
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $role
     * @param  string $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        if (Auth::guest()) {
            return back(302);
        }

        if (auth()->user()->hasRole($role)) {
            return $next($request);
        }

        if (! is_null($permission)) {
            if (auth()->user()->can($permission)) {
                return $next($request);
            }
        }

        return abort(403);
    }
}
