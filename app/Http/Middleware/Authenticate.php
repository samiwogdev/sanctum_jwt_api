<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
/**
 * script for storing user auth token in cookies
 * Overriding the default function in C:\xampp\htdocs\api\sanctum_jwt_api\vendor\laravel\framework\src\Illuminate\Auth\Middleware\Authenticate.php
 */
 public function handle($request, Closure $next, ...$guards)
    {
        //get the jwt token from the cookie
        if($jwt = $request->cookie('jwt')){
            //manually set it to the header
            $request->headers->set('Authorization', 'Bearer '. $jwt);
        }
        $this->authenticate($request, $guards);

        return $next($request);
    }
}
