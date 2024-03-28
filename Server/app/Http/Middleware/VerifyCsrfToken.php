<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Los URIs que deberían estar exentos de la verificación CSRF.
     *
     * @var array
     */
    protected $except = [
        '/tasks',
    ];
}
