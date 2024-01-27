<?php

namespace App\Http\MiddlewareCustom;

use App\Models\UserGroup;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $user = Auth::user();

        if (session('is_administrator')) return $next($request);

        if ($user && session('usergroup_id')) {
            $access = json_decode(UserGroup::where('id', session('usergroup_id'))->first()->access) ?? null;
            if (!$access) return redirect('/');

            if ($access->$roles) return $next($request);
        }

        return redirect('/');
    }
}
