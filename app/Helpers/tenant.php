<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

if (! function_exists('tenant_connect')) {
    function tenant_connect($database): void
    {
        DB::purge('tenant');
        config()->set('database.connections.tenant.database', $database);
        DB::reconnect('tenant');

        Schema::connection('tenant')->getConnection()->reconnect();
    }
}
