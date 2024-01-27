<?php

namespace App\Http\MiddlewareCustom;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SaveOriginUrlWhenLoadingForm
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $origin = Str::replace($request->server('HTTP_HOST'), '', substr($request->server('HTTP_REFERER'), (Str::contains($request->server('HTTP_REFERER'), 'https') ? 8 : 7)));
        $destination = $request->server('PATH_INFO');

        if ($destination) {
            $origin = $origin === '' ? '/' . explode('/', $destination)[1] : $origin;
        }

        // if origin <> destination, store origin to session
        if ($origin !== $destination && !Str::contains($origin, ['create', 'edit', 'approve', 'reject'])) {
            // dd($origin, $destination, session('origin'));
            session()->put('origin', $origin);
            // dd(session('origin'));
        }

        return $next($request);
    }
}
