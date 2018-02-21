<?php

namespace chatty\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAnu
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
          if (Auth::user()->first_name !== 'Anu') {
                return abort(403, 'Unauthorized Access, User is not Anu.');
          }
        return $next($request);
    }
}
