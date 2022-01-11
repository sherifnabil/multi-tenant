<?php

namespace App\Listeners;

use App\Events\UserWasCreated;
use App\Tenant\DatabaseCreator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreatedUser
{
    protected $databaseCreator;

    public function __construct(DatabaseCreator $databaseCreator)
    {
        $this->databaseCreator = $databaseCreator;
    }


    public function handle(UserWasCreated $event): void
    {
        if (!$this->databaseCreator->create($event->user)) {
            throw  new \Exception("Database failed to be created.");
        }
    }
}
