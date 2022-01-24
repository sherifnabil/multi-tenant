<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TenantByToken
{
    public function handle(Request $request, Closure $next)
    {
        // dd(session('tenant_db')); // logged in user saved in session
        if (auth()->user()) {
            $database = auth()->user()->db_name;

            tenant_connect($database);
        }
        return $next($request);
    }
}
