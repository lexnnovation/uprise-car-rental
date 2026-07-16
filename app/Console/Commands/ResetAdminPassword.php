<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetAdminPassword extends Command
{
    protected $signature = 'admin:reset-password {email} {password}';

    protected $description = 'Reset (or create) a Filament admin user\'s password.';

    public function handle(): int
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::firstOrNew(['email' => $email]);
        $isNew = ! $user->exists;

        if ($isNew) {
            $user->name = $this->ask('New user — what name should be used?', 'Admin');
        }

        $user->password = $password;
        $user->save();

        $this->info(($isNew ? 'Created' : 'Updated') . " user {$email}.");

        return self::SUCCESS;
    }
}
