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

        //AKUN DIVISI ADMIN
        User::create([
            'username' => 'rby/admin/shafa',
            'email' => 'shafaeriana@gmail.com',
            'divisi' => 'Admin',
            'password' => Hash::make('shafa123'),
        ]);
        User::create([
            'username' => 'rby/admin/mieke',
            'email' => 'mieketarigan@gmail.com',
            'divisi' => 'Admin',
            'password' => Hash::make('mieke123'),
        ]);

        //AKUN DIVISI PENILAI
        User::create([
            'username' => 'rby/surveyor/richard',
            'email' => 'richard.barus33@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('richard123'),
        ]);
        User::create([
            'username' => 'rby/surveyor/robbi',
            'email' => 'ragaforex88@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('robbi123'),
        ]);
        User::create([
            'username' => 'rby/surveyor/firdaus',
            'email' => 'dausgtg02@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('firdaus123'),
        ]);
        User::create([
            'username' => 'rby/surveyor/amri',
            'email' => 'cbnex13@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('amri123'),
        ]);
        User::create([
            'username' => 'rby/surveyor/fajar',
            'email' => '20nya.fajartambunan@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('fajar123'),
        ]);
        User::create([
            'username' => 'rby/surveyor/jasmani',
            'email' => 'jasmanig97@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('jasmani123'),
        ]);
        User::create([
            'username' => 'rby/surveyor/santo',
            'email' => 'antocornelius.g@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('santo123'),
        ]);
        User::create([
            'username' => 'rby/surveyor/pretty',
            'email' => 'prettybalerina@icloud.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('pretty123'),
        ]);
        User::create([
            'username' => 'rby/surveyor/benhur',
            'email' => 'benhurpopuler2002@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('benhur123'),
        ]);
        User::create([
            'username' => 'rby/surveyor/elma',
            'email' => 'elmaagnes02@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('elma123'),
        ]);

        //AKUN DIVISI EDP
        User::create([
            'username' => 'rby/edp/aprilius',
            'email' => 'rutsahanayasembiring@gmail.com',
            'divisi' => 'EDP',
            'password' => Hash::make('aprilius123'),
        ]);
        User::create([
            'username' => 'rby/edp/michael',
            'email' => 'michaelbp3105@gmail.com',
            'divisi' => 'EDP',
            'password' => Hash::make('michael123'),
        ]);
        User::create([
            'username' => 'rby/edp/yohanes',
            'email' => 'yohaneskrollkoten@gmail.com',
            'divisi' => 'EDP',
            'password' => Hash::make('yohanes123'),
        ]);
        
        //AKUN DIVISI REVIEWER
        User::create([
            'username' => 'rby/reviewer/mega',
            'email' => 'MegaPermataSari400@gmail.com',
            'divisi' => 'Reviewer',
            'password' => Hash::make('mega123'),
        ]);

        //AKUN DIVISI FINANCE
        User::create([
            'username' => 'rby/finance/amelia',
            'email' => 'ameliaawandi@gmail.com',
            'divisi' => 'Finance',
            'password' => Hash::make('amelia123'),
        ]);
        User::create([
            'username' => 'rby/finance/matta',
            'email' => 'mattaega1@gmail.com',
            'divisi' => 'Finance',
            'password' => Hash::make('matta123'),
        ]);

        //AKUN DIVISI IT
        User::create([
            'username' => 'rby/it/aldi',
            'email' => 'aldijhont@gmail.com',
            'divisi' => 'IT',
            'password' => Hash::make('aldi123'),
            'nama' => 'Aldi Jhont Travolta',
            'alamat' => 'Jl. Mawar No. 5',
            'nohp' => '082113266662',
            'jabatan' => 'Staff',
        ]);
    }
}
