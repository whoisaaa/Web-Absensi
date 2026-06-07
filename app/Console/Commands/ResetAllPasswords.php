<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ResetAllPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Usage: php artisan user:reset-all-passwords {password?}
     * If no password is provided, a default 'password123' will be used.
     */
    protected $signature = 'user:reset-all-passwords {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the password for all users to a default or provided password';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $newPassword = $this->argument('password') ?? 'password123';
        $hashed = bcrypt($newPassword);

        $affected = User::query()->update(['password' => $hashed]);

        $this->info("Passwords for {$affected} user(s) have been reset to '{$newPassword}'.");
        return 0;
    }
}
