<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param null $permission
     * @param null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role = null, $guard = null): mixed
    {
        $authGuard = app('auth')->guard($guard);

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $permissions = $this->parsePermission($request, $role);

        foreach ($permissions as $permission) {
            if ($authGuard->user()->can($permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
    }

    /**
     * @param Request $request
     * @param string|array|null $role
     * @return null[]
     */
    private function parsePermission(Request $request, null|string|array $role): array
    {
        if (!is_null($role)) {
            $permissions = is_array($role)
                ? $role
                : explode('|', $role);
        }

        if (is_null($role)) {
            $permissions = [$request->route()?->getName()];
        }

        return $permissions;
    }
}
