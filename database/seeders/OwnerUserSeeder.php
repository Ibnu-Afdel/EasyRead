<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OwnerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('role', 'owner')->exists()) {
            User::create([
                'name' => env('DEFAULT_ADMIN_NAME', 'Admin'),
                'email' => env('DEFAULT_ADMIN_EMAIL', 'admin@example.com'),
                'password' => Hash::make(env('DEFAULT_ADMIN_PASSWORD', 'password')),
                'role' => 'owner'
            ]);
        }
    }
}
