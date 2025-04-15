<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => env('FISHORA_ADMIN_EMAIL')],
            [
                'name' => 'Super Admin',
                'password' => Hash::make(env('FISHORA_ADMIN_PASSWORD')),
                'email_verified_at' => now(),
            ]
        );
    }
}
