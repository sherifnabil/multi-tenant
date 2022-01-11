<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenantDatabase
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()) {
            $database = auth()->user()->db_name;
            config()->set('database.connections.mysql.database', $database);
            DB::purge('mysql');
        }
        return $next($request);
    }
}
