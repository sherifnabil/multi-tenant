<?php
declare(strict_types=1);

namespace App\Tenant;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class DatabaseCreator
{
    public $database;

    public function create(User $user): bool
    {
        DB::statement($this->getDatabaseCreateStatement($user));
        $this->migrate();
        return true;
    }

    private function getDatabaseCreateStatement(User $user): string
    {
        $database = $this->getTenantDatabaseName($user);
        return sprintf("CREATE DATABASE IF NOT EXISTS `%s`", $database);
    }

    private function getTenantDatabaseName(User $user): string
    {
        $this->database = $user->db_name;
        return $this->database;
    }

    // Please note that for customizing the connection you can
    // specify mysql or whatever your DB connection array
    private function migrate(): void
    {
        DB::purge('mysql');
        config()->set('database.connections.mysql.database', $this->database);
        Artisan::call('migrate', [
            "--path"=> "/database/migrations/tenant",
            '--force' => true
        ]);
        DB::purge('mysql');
    }
}
