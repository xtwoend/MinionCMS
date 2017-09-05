<?php

namespace Minion\Themes\Middleware;


use Closure;

class SetCurrentTheme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $theme)
    {
        
        app('themes')->set($theme);

        return $next($request);
    }
}
