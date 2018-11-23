<?php

namespace App\Http\Middleware;

use Closure;

class DemoVersion
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
        if ($request->isMethod('POST') || $request->isMethod('PUT') || $request->isMethod('DELETE'))
        {
            return back()->with('alert', 'Demo Version. Can Not Change');
        }
        return $next($request);
    }
}
