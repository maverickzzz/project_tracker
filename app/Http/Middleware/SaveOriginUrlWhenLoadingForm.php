<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class SaveOriginUrlWhenLoadingForm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $origin = Str::replace($request->server('HTTP_HOST'), '', substr($request->server('HTTP_REFERER'), (Str::contains($request->server('HTTP_REFERER'), 'https') ? 8 : 7)));
        $destination = $request->server('PATH_INFO');

        // if origin <> destination, store origin to session
        if ($origin !== $destination && !Str::contains($origin, ['create', 'edit'])) {
            // dd($origin, $destination, session('origin'));
            session()->put('origin', $origin);
            // dd(session('origin'));
        }

        return $next($request);
    }
}
