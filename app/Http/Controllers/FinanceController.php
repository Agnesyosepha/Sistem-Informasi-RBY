<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Rab;

class FinanceController extends Controller
{
    // Dashboard Finance
    public function dashboard()
    {
        $rabs = Rab::all();
        return view('layouts.finance', compact('rabs'));
    }

    // Tim Finance
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

    // Invoice dummy
    public function invoice()
    {
        $invoice = [
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
            // dst...
        ];

        return view('finance.invoice', compact('invoice'));
    }

    public function SAinvoice()
    {
        $invoice = Invoice::all();
        return view('finance.SAinvoice', compact('invoice'));
    }

    public function rabIndex()
    {
        $rabs = Rab::all();
        return view('finance.SArab', compact('rabs'));
    }

    public function rabCreate()
    {
        return view('superadmin.finance.rab.create');
    }

    public function rabStore(Request $request)
    {
        Rab::create($request->all());
        return redirect()->route('superadmin.rab')->with('success', 'Data RAB berhasil ditambahkan!');
    }

    public function rabEdit($id)
    {
        $rab = Rab::findOrFail($id);
        return view('superadmin.finance.rab.edit', compact('rab'));
    }

    public function rabUpdate(Request $request, $id)
    {
        $rab = Rab::findOrFail($id);
        $rab->update($request->all());
        return redirect()->route('superadmin.rab')->with('success', 'Data berhasil diupdate!');
    }

    public function rabDelete($id)
    {
        Rab::destroy($id);
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
