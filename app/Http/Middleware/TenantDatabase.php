<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenantDatabase
{
    public function handle(Request $request, Closure $next)
    {
        // dd(request()->all());
        if (auth()->user()) {
            $database = auth()->user()->db_name;

            if (!session('tenant_db')) {
                session()->put('tenant_db', $database);
            }

            DB::purge('tenant');
            tenant_connect($database);
            // config()->set('database.connections.tenant.database', $database);
            // DB::purge('tenant');
        }
        return $next($request);
    }
}
