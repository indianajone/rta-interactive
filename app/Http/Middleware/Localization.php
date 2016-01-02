<?php

namespace App\Http\Middleware;

use Closure;

class Localization
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
        if (in_array($request->segment(1), ['th', 'en'])) {
            session()->put('locale', $request->segment(1));
        }

        if (!session()->has('locale')) {
            session()->put('locale', config('app.locale'));
        }

        app()->setLocale(session()->get('locale'));

        return $next($request);
    }
}
