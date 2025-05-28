<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

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
        // Kiểm tra nếu đường dẫn có chứa "manager"
        if (! $request->expectsJson()) {
            if (strpos($request->path(), 'manager') !== false) {
                // Quay về trang login của manager
                return route('manager.login.index');
            } else {
                // Quay về trang home nếu không phải manager
                return route('home');
            }
        }
    }
}


