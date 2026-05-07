<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Idempotent: safe to re-run. Creates the default Filament admin
     * if one with the canonical email does not yet exist.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@uprise.test'],
            [
                'name' => 'Uprise Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );
    }
}
