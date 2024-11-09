<?php

namespace App\Http\Middleware;

use App\Services\Firewall;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBots
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app(Firewall::class)->isBot($request)) {
            return redirect('https://site.facturis.ma/');
        }

        return $next($request);
    }
}
