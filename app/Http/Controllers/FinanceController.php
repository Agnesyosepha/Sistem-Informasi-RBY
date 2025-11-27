<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function dashboard()
    {
        return view('finance.timFinance'); 
    }

    public function tim()
    {
        $timFinance = [
            [
                'nama' => 'Amelia Awandi', 
                'nohp' => '081384536186', 
                'email' => 'ameliaawandi@gmail.com', 
                'status' => 'Aktif'
            ],
        ];

        return view('finance.timFinance', compact('timFinance'));
    }
}
