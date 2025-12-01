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
            'nama' => 'Shafa Az-zahra Eriana',
            'alamat' => 'Jl. Petamburan 2, Tanah Abang, Jakarta',
            'nohp' => '0895-3121-80247',
            'jabatan' => 'Staff',
            'mappi' => '25-A-13488',
        ]);
        User::create([
            'username' => 'rby/admin/mieke',
            'email' => 'mieketarigan@gmail.com',
            'divisi' => 'Admin',
            'password' => Hash::make('mieke123'),
            'nama' => 'Mieke Dearni Br Tarigan',
            'alamat' => 'Pondok Pekayon Indah, Jl. Pakis Raya, Bekasi Selatan',
            'nohp' => '0822-8850-8800',
            'jabatan' => 'Staff',
            'mappi' => '-'
        ]);

        //AKUN DIVISI PENILAI
        User::create([
            'username' => 'rby/surveyor/richard',
            'email' => 'richard.barus33@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('richard123'),
            'nama' => 'Richard Barus',
            'alamat' => '',
            'nohp' => '0812-8636-5116',
            'jabatan' => 'Staff',
            'mappi' => '-',
        ]);
        User::create([
            'username' => 'rby/surveyor/robbi',
            'email' => 'ragaforex88@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('robbi123'),
            'nama' => 'Robbi Sugara Ginting',
            'alamat' => '',
            'nohp' => '0821-2358-0669',
            'jabatan' => 'Staff',
            'mappi' => '',
        ]);
        User::create([
            'username' => 'rby/surveyor/firdaus',
            'email' => 'dausgtg02@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('firdaus123'),
            'nama' => 'Firdaus Ginting',
            'alamat' => 'Jl. Rose Garden Boulevard No.35, Bekasi Selatan',
            'nohp' => '0813-1246-7274',
            'jabatan' => 'Staff',
            'mappi' => '22-A-11580',
        ]);
        User::create([
            'username' => 'rby/surveyor/amri',
            'email' => 'cbnex13@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('amri123'),
            'nama' => 'Amri Simbolon',
            'alamat' => 'Perumahan Graha Harapan Blok E 13 No. 14',
            'nohp' => '0811-1214-890',
            'jabatan' => 'Staff',
            'mappi' => '19-P-09485',
        ]);
        User::create([
            'username' => 'rby/surveyor/fajar',
            'email' => '20nya.fajartambunan@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('fajar123'),
            'nama' => 'Fajar Hariyadi',
            'alamat' => '',
            'nohp' => '0838-7009-5867',
            'jabatan' => 'Staff',
            'mappi' => '-',
        ]);
        User::create([
            'username' => 'rby/surveyor/jasmani',
            'email' => 'jasmanig97@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('jasmani123'),
            'nama' => 'Jasmani Ginting',
            'alamat' => 'Jl. Bacang Raya No. 135, Bekasi Selatan',
            'nohp' => '0813-6293-0556',
            'jabatan' => 'Staff',
            'mappi' => '24-A-12448',
        ]);
        User::create([
            'username' => 'rby/surveyor/santo',
            'email' => 'antocornelius.g@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('santo123'),
            'nama' => 'Santo Cornelius Ginting',
            'alamat' => 'Jl. Sutoyo No.29, Cililitan, Jakarta',
            'nohp' => '0811-6511-109',
            'jabatan' => 'Staff',
            'mappi' => '12-P-03569',
        ]);
        User::create([
            'username' => 'rby/surveyor/pretty',
            'email' => 'prettybalerina@icloud.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('pretty123'),
            'nama' => 'Pretty Balerina Br Bangun',
            'alamat' => '',
            'nohp' => '0857-8207-8806',
            'jabatan' => 'Staff',
            'mappi' => '-',
        ]);
        User::create([
            'username' => 'rby/surveyor/benhur',
            'email' => 'benhurpopuler2002@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('benhur123'),
            'nama' => 'Benhur Sumanraja Sembiring',
            'alamat' => 'Jl. Bojong Rawalumbu, Bekasi',
            'nohp' => '0858-3097-6179',
            'jabatan' => 'Staff',
            'mappi' => '25-A-14054',
        ]);
        User::create([
            'username' => 'rby/surveyor/elma',
            'email' => 'elmaagnes02@gmail.com',
            'divisi' => 'Surveyor',
            'password' => Hash::make('elma123'),
            'nama' => 'Elma Agnes Silitonga',
            'alamat' => 'Jl pondok gede permai, Jatiasih, Bekasi',
            'nohp' => '0812-8858-1609',
            'jabatan' => 'Staff',
            'mappi' => '25-A-14278',
        ]);

        //AKUN DIVISI EDP
        User::create([
            'username' => 'rby/edp/aprilius',
            'email' => 'rutsahanayasembiring@gmail.com',
            'divisi' => 'EDP',
            'password' => Hash::make('aprilius123'),
            'nama' => 'Aprilius Ginting',
            'alamat' => 'Jl. Rose Garden Boulevard No.35, Bekasi Selatan',
            'nohp' => '0821-2230-2387',
            'jabatan' => 'Staff',
            'mappi' => '24-A-12446',
        ]);
        User::create([
            'username' => 'rby/edp/michael',
            'email' => 'michaelbp3105@gmail.com',
            'divisi' => 'EDP',
            'password' => Hash::make('michael123'),
            'nama' => 'Michael Brema Pinem',
            'alamat' => 'Jl. Bukit Tunggul 4, Bekasi Selatan',
            'nohp' => '0895-3387-33453',
            'jabatan' => 'Staff',
            'mappi' => '25-A-13583',
        ]);
        User::create([
            'username' => 'rby/edp/yohanes',
            'email' => 'yohaneskrollkoten@gmail.com',
            'divisi' => 'EDP',
            'password' => Hash::make('yohanes123'),
            'nama' => 'Yohanes Kroll Koten',
            'alamat' => 'Jl. Bojong Indah VI, Bojong Rawalumbu, Bekasi',
            'nohp' => '0896-7574-0893',
            'jabatan' => 'Staff',
            'mappi' => '-'
        ]);
        
        //AKUN DIVISI REVIEWER
        User::create([
            'username' => 'rby/reviewer/mega',
            'email' => 'MegaPermataSari400@gmail.com',
            'divisi' => 'Reviewer',
            'password' => Hash::make('mega123'),
            'nama' => 'Mega Permata Sari Br Ginting',
            'alamat' => 'Jl. Pakis Raya BB 30 No.1 Bekasi Selatan',
            'nohp' => '0813-8453-6186',
            'jabatan' => 'Staff',
            'mappi' => '22-P-11721',
        ]);

        //AKUN DIVISI FINANCE
        User::create([
            'username' => 'rby/finance/amelia',
            'email' => 'ameliaawandi@gmail.com',
            'divisi' => 'Finance',
            'password' => Hash::make('amelia123'),
            'nama' => 'Amelia Awandi',
            'alamat' => 'Bekasi',
            'nohp' => '0813-8453-6186',
            'jabatan' => 'Staff',
            'mappi' => '-',
        ]);
        User::create([
            'username' => 'rby/finance/matta',
            'email' => 'mattaega1@gmail.com',
            'divisi' => 'Finance',
            'password' => Hash::make('matta123'),
            'nama' => 'Matta Ega Sihombing',
            'alamat' => 'New Liverpool P18 C11 Mutiara Gading City, Bekasi',
            'nohp' => '0812-6204-4499',
            'jabatan' => 'Staff',
            'mappi' => '-',
        ]);

        //AKUN DIVISI IT
        User::create([
            'username' => 'rby/it/aldi',
            'email' => 'aldijhont@gmail.com',
            'divisi' => 'IT',
            'password' => Hash::make('aldi123'),
            'nama' => 'Aldi Jhont Travolta',
            'alamat' => 'Jl. Bengkong',
            'nohp' => '082113266662',
            'jabatan' => 'Staff',
            'mappi' => '-',
        ]);
    }
}
