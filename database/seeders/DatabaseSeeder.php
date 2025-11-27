<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'user',
            'email' => 'user@example.com',
            'divisi' => 'User',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'divisi' => 'Admin',
            'password' => Hash::make('abcdef'),
        ]);

        User::create([
            'username' => 'rby/agnes',
            'email' => 'agnes@example.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('agnes123'),
        ]);

        User::create([
            'username' => 'rby/grace',
            'email' => 'grace@example.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('grace123'),
        ]);
    }
}
