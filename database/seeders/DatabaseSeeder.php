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
        // Hapus yang pakai name & email
        // Sesuaikan dengan kolom yang ada (username, password)
        User::create([
            'username' => 'admin',
            'password' => Hash::make('123456'),
        ]);

        // atau kalau mau pakai UserSeeder
        // $this->call(UserSeeder::class);
    }
}
