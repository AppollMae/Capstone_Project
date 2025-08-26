<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SetOfflineUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:set-offline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set users offline if inactive for more than 5 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $threshold = now()->subMinutes(5);

        User::where('status', 'active')
            ->whereIn('role', ['MPDO', 'BFP', 'Treasurer']) // Only these roles
            ->where('last_seen', '<', $threshold)
            ->update(['status' => 'inactive']);

        $this->info('Offline users updated successfully.');
    }
}
