<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAllowedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permissionName, ?string $columnName = null): Response
    {
        $modelPattern = implode('|', array_keys(RouteServiceProvider::EXPLICIT_BINDINGS));
        $user = Auth::user();
        preg_match_all("/{(?<models>$modelPattern)}/", $request->route()->uri, $bindings);
        $isOwner = !collect($bindings['models'])->contains(fn ($model) => $request->route($model)->{$columnName} != $user->id);

        throw_unless($isOwner || $user->can($permissionName), \Illuminate\Auth\Access\AuthorizationException::class);
        return $next($request);
    }
}
