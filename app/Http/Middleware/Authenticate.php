<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

/**
 * Class Authenticate authenticate user
 *
 * @package App\Http\Middleware
 */
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request Request object
     *
     * @return string|null
     */
    protected function redirectTo(Request $request)
    {
        if (! $request->expectsJson()) {
            return route('user-login');
        }
    }
}
