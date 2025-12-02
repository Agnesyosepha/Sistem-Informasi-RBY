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

    // Invoice

    public function invoice(Request $request)
  {
      $query = Invoice::query();

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

      $invoice = $query->orderBy('id', 'desc')->get();

      return view('finance.invoice', compact('invoice'));
  }


    public function SAinvoice()
    {
        $invoice = Invoice::all();
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

    // Update checkbox
      if ($request->has('checked')) {
        $invoice->checked = $request->checked ? 1 : 0;
      }

      $invoice->save();

      return response()->json(['success' => true]);
    }



    // RAB
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
