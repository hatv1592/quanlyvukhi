<?php

namespace App\Http\Middleware;

use App\Model\RoleUserModel;
use Closure;
use Illuminate\Support\Facades\Auth;


class AuthCatManager
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
//        die('ddd');
        //Kem tra session da ton tai hay chua
        //Neu co thi Next Request
        //Neu khong co thi chuyen tơi trang Login
        if (Auth::guard($guard)->guest()) {

            if ($request->ajax() || $request->wantsJson()) {

                return response('Unauthorized.', 401);
            } else {

                return redirect()->guest('login');
            }
        }
        if (RoleUserModel::hasRoleCatManager(Auth::guard($guard)->user()->id) == false) {
            return redirect()->guest('error');
        }
        return $next($request);
    }

}
