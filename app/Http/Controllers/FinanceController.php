<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    // Halaman dashboard Finance (resources/views/layouts/finance.blade.php)
    public function dashboard()
    {
        return view('layouts.finance'); // Dashboard Finance
    }

    // Halaman tim Finance (resources/views/finance/timFinance.blade.php)
    public function tim()
    {
        $timFinance = [
            [
                'nama' => 'Amelia Awandi', 
                'nohp' => '0813-8453-6186', 
                'email' => 'ameliaawandi@gmail.com', 
                'status' => 'Aktif'
            ],
            [
                'nama' => 'Matta Ega Sihombing', 
                'nohp' => '0812-6204-4499', 
                'email' => 'mattaega1@gmail.com', 
                'status' => 'Aktif'
            ],
        ];

        return view('finance.timFinance', compact('timFinance'));
    }
}
