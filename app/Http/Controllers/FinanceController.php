<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

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

    // Invoice

    public function invoice()
{
    $invoice = 
    [
        [
            'tanggal_pembuat' => '08 Nov 2025',
            'no_invoice' => 'PT Sumber Jaya',
            'no_ppjp' => '1.200.000',
            'nama_klien' => 'Budi Santoso',
            'pemberi_tugas' => 'Rp 1.500.000',
            'status' => 'Disetujui',
            'checked' => false,
            'disabled' => false
        ],
        [
            'tanggal_pembuat' => '09 Nov 2025',
            'no_invoice' => 'CV Cahaya Baru',
            'no_ppjp' => '900.000',
            'nama_klien' => 'Siti Aulia',
            'pemberi_tugas' => 'Rp 900.000',
            'status' => 'Menunggu',
            'checked' => true,
            'disabled' => true
        ],
        [
            'tanggal_pembuat' => '10 Nov 2025',
            'no_invoice' => 'PT Andalan Sejahtera',
            'no_ppjp' => '750.000',
            'nama_klien' => 'Reza Fadillah',
            'pemberi_tugas' => 'Rp 800.000',
            'status' => 'Disetujui',
            'checked' => false,
            'disabled' => true
        ],
        [
            'tanggal_pembuat' => '11 Nov 2025',
            'no_invoice' => 'Koperasi Maju',
            'no_ppjp' => '1.050.000',
            'nama_klien' => 'Andi Wijaya',
            'pemberi_tugas' => 'Rp 1.200.000',
            'status' => 'Menunggu',
            'checked' => false,
            'disabled' => false
        ],
        [
            'tanggal_pembuat' => '12 Nov 2025',
            'no_invoice' => 'PT Digital Nusantara',
            'no_ppjp' => '1.600.000',
            'nama_klien' => 'Nadia Putri',
            'pemberi_tugas' => 'Rp 1.600.000',
            'status' => 'Disetujui',
            'checked' => true,
            'disabled' => true
        ],
        [
            'tanggal_pembuat' => '13 Nov 2025',
            'no_invoice' => 'PT Mandiri Global',
            'no_ppjp' => '1.300.000',
            'nama_klien' => 'Yoga Pranata',
            'pemberi_tugas' => 'Rp 1.450.000',
            'status' => 'Disetujui',
            'checked' => false,
            'disabled' => false
        ],
    ];

    return view('finance.invoice', compact('invoice'));
}

    
    public function SAinvoice()
    {
        $invoice = Invoice::all();
        return view('finance.SAinvoice', compact('invoice'));
    }
}
