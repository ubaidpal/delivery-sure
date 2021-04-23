<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        \View::share(['user_id' => \Auth::id()]);

        $user = \Auth::user();
        if($user->user_type != 1) {
            return redirect('/');
        }
        return $next($request);
    }
}
