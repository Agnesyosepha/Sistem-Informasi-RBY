<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::create([
            'username' => 'user',
            'password' => Hash::make('123456'),
        ]);
        User::create([
            'username' => 'admin',
            'password' => Hash::make('abcdef'),
        ]);


    }
}
