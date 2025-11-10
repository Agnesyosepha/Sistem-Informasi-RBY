<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EdpController extends Controller
{
  public function staff()
  {
      $staff = [
          ['nama' => 'Aprilius Ginting', 'nohp' => '0812-2981-1849', 'status' => 'Aktif'],
            ['nama' => 'Michael Brema Pinem', 'nohp' => '0812-2981-1849', 'status' => 'Aktif'],
            ['nama' => 'Yohanes Kroll Koten', 'nohp' => '0812-2981-1849', 'status' => 'Aktif'],
      ];

      return view('EDP.edp', compact('staff'));
  }
}