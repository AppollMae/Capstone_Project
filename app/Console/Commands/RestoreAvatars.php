<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Http\File;

class RestoreAvatars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:restore-avatars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore missing avatar files from backup folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $localPath = public_path('backup_avatars/' . $user->avatar);
            if (file_exists($localPath)) {
                Storage::disk('public')->putFileAs('avatars', new File($localPath), $user->avatar);
                $this->info("Restored: " . $user->avatar);
            } else {
                $this->warn("Missing: " . $user->avatar);
            }
        }

        $this->info('Avatar restore completed!');
    }
}
