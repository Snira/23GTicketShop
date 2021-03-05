<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RuntimeException;

final class IsAjax
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
//        if (!$request->ajax()){
//            throw new RuntimeException('Request was expected to be ajax.');
//        }

        return $next($request);
    }
}
