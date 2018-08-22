<?php

namespace App\Http\Middleware;

use App\Model\RoleUserModel;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;


class AuthLogin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //Neu khong co thi chuyen tơi trang Login
        if (Auth::guard($guard)->guest()) {

            if ($request->ajax() || $request->wantsJson()) {

                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }
        if (User::isSuperAdmin()) {
            return $next($request);
        }
        if (User::isUser()) {
            return $next($request);
        }
        if (User::isReader()) {
            if (!request()->isMethod('get')) {
                return redirect()->guest('error');
            }
        }
        return $next($request);
    }

}
