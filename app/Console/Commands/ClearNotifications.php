<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearNotifications extends Command
{
    protected $signature = 'notifications:clear';
    protected $description = 'Clear all notifications from the database';

    public function handle()
    {
        $count = DB::table('notifications')->count();

        DB::table('notifications')->truncate();

        $this->info("Successfully cleared {$count} notifications.");
    }
}
