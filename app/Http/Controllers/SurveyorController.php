<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyorController extends Controller
{
    public function index()
    {
        return view('surveyor.index');
    }

    public function tim()
    {
        $tim = [
            ['nama' => 'Dazai', 'nohp' => '0812-2981-1849', 'status' => 'Aktif'],
            ['nama' => 'Ranpo', 'nohp' => '0821-7894-1175', 'status' => 'Cuti'],
            ['nama' => 'Naomi', 'nohp' => '0853-4568-9845', 'status' => 'Aktif'],
            ['nama' => 'Chuuya', 'nohp' => '0813-8841-2781', 'status' => 'Aktif'],
        ];

        return view('surveyor.timsurveyor', compact('tim'));
    }

}
