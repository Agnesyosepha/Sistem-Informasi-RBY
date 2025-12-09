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
        $rabs = Rab::orderBy('id', 'desc')->get();
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


// Invoice

    
    public function invoice(Request $request)
    {
        $query = Invoice::query();

        // FILTER SEARCH
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('tanggal_pembuat', 'like', "%$search%")
                  ->orWhere('no_invoice', 'like', "%$search%")
                  ->orWhere('no_ppjp', 'like', "%$search%")
                  ->orWhere('nama_klien', 'like', "%$search%")
                  ->orWhere('pemberi_tugas', 'like', "%$search%")
                  ->orWhere('status', 'like', "%$search%");
            });
        }

        // FILTER BULAN
        if ($request->bulan) {
            $query->whereMonth('tanggal_pembuat', $request->bulan);
        }

        $invoice = $query->orderBy('id', 'desc')->get();

        return view('finance.invoice', compact('invoice'));
    }

    public function SAinvoice()
    {
        $invoice = Invoice::orderBy('id', 'desc')->get();
        return view('finance.SAinvoice', compact('invoice'));
    }

    public function storeInvoice(Request $request)
    {
        $validated = $request->validate([
            'tanggal_pembuat' => 'required|date',
            'no_invoice' => 'required|string|max:255',
            'no_ppjp' => 'required|string|max:255',
            'nama_klien' => 'required|string|max:255',
            'pemberi_tugas' => 'required|string|max:255',
            'pengguna_laporan' => 'required|string|max:255',
            'termin' => 'required|string',
            'biaya_jasa' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        Invoice::create($validated);

        return redirect()->route('superadmin.finance.SAinvoice')
                       ->with('success', 'Invoice berhasil ditambahkan!');
    }

    public function updateStatus(Request $request)
    {
        $invoice = Invoice::find($request->id);

        if (!$invoice) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Update status
        if ($request->has('status')) {
            $invoice->status = $request->status;
        }

        // Update termin
        if ($request->has('termin')) {
            $invoice->termin = $request->termin;
        }

        // Update checkbox
        if ($request->has('checked')) {
            $invoice->checked = $request->checked ? 1 : 0;
        }

        $invoice->save();

        return response()->json(['success' => true]);
    }
    
    public function uploadFile(Request $request)
    {
    if (!$request->hasFile('file')) {
        return response()->json([
            'success' => false,
            'message' => 'File tidak ditemukan'
        ]);
    }

    $request->validate([
        'file' => 'required|mimes:jpg,jpeg,png,pdf|max:5000'
    ]);

    $invoice = Invoice::find($request->id);

    if (!$invoice) {
        return response()->json([
            'success' => false,
            'message' => 'Invoice tidak ditemukan'
        ]);
    }

    $field = $request->field; // bukti_dp atau bukti_pelunasan

    // Upload file
    $path = $request->file('file')->store('invoice_files', 'public');

    // Simpan ke database
    $invoice->$field = $path;
    $invoice->save();

    return response()->json([
        'success' => true,
        'message' => 'Upload berhasil',
        'file' => $path
    ]);
}





// RAB
    public function rabIndex()
    {
        $rabs = Rab::orderBy('id', 'desc')->get();
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
    public function rabUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $rab = Rab::findOrFail($id);
        $rab->status = $request->status;
        $rab->save();

        return redirect()->back()->with('success', 'Status RAB berhasil diupdate');
    }

}
