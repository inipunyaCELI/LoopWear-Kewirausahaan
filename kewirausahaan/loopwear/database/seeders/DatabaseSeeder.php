<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'atmin',
            'email' => 'atmin@gmail.com',
            'username' => 'atmin',
            'password' => Hash::make('54321'),
            'role' => 'admin',
        ]);

    }
}