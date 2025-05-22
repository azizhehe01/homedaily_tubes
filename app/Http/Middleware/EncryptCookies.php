<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EncryptCookies
{
    protected $except = [
        // Add any cookies that should not be encrypted here
    ];
}
