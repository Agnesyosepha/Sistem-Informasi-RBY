@extends('superadmin.app2')

@section('title', 'Invoice Admin')

@section('content')

<h1><i class="fas fa-file-invoice"></i> Invoice Admin</h1>
<p>Data - data keuangan yang perlu divalidasi.</p>

<!-- Tombol Tambah -->
<button onclick="document.getElementById('modalTambah').style.display='block'"
    style="background:#28a745; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-top:20px;">
    + Tambah Invoice
</button>


<!-- Modal Tambah Invoice -->
<div id="modalTambah" 
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
     background:rgba(0,0,0,0.5); padding-top:80px;">

    <div style="background:white; width:400px; margin:auto; padding:20px; border-radius:8px;">
        <h3>Tambah Invoice</h3>

        <form method="POST" action="{{ route('superadmin.finance.storeInvoice') }}">
            @csrf

            <label>Tanggal Pembuat:</label>
            <input type="date" name="tanggal_pembuat" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>No Invoice:</label>
            <input type="text" name="no_invoice" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>No PPJP / Adendum:</label>
            <input type="text" name="no_ppjp" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Debitur:</label>
            <input type="text" name="nama_klien" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Pemberi Tugas:</label>
            <input type="text" name="pemberi_tugas" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">

            <label>Pengguna Laporan:</label> 
            <input type="text" name="pengguna_laporan" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">
    
            <label>Status:</label>
            <select name="status" required
                style="width:100%; padding:8px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;">
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
            </select>

            <button type="submit"
                style="background:#007BFF; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
                Simpan
            </button>

            <button type="button" 
                onclick="document.getElementById('modalTambah').style.display='none'"
                style="background:#dc3545; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer; margin-left:10px;">
                Batal
            </button>
        </form>
    </div>
</div>



<div class="dashboard-card" style="margin-top:20px;">
        <h3><i class="fas fa-receipt"></i> Data Invoice</h3>

        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                 <tr style="background:#007BFF; color:white;">
                    <th style="padding:10px; text-align:left;">Tanggal Pembuat</th>
                    <th style="padding:10px; text-align:left;">No. Invoice</th>
                    <th style="padding:10px; text-align:left;">No. PPJP/No. Adendum</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:left;">Pengguna Laporan</th>
                    <th style="padding:10px; text-align:left;">Status</th>
                    <th style="padding:10px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($invoice as $item)
              <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $item['tanggal_pembuat'] }}</td>
                <td style="padding:10px;">{{ $item['no_invoice'] }}</td>
                <td style="padding:10px;">{{ $item['no_ppjp'] }}</td>
                <td style="padding:10px;">{{ $item['nama_klien'] }}</td>
                <td style="padding:10px;">{{ $item['pemberi_tugas'] }}</td>
                <td style="padding:10px;">{{ $item['pengguna_laporan'] }}</td>
                <td style="padding:10px;">
                    <select onchange="changeColor(this); updateInvoice({{ $item->id }}, 'status', this.value)"
                        style="padding:10px; font-weight:600; border-radius:5px;">       
                        <option value="Paid" {{ $item->status == 'Paid' ? 'selected' : '' }}>Paid</option>        
                        <option value="Unpaid" {{ $item->status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>    
                    </select>
                </td>
                <td style="padding:10px; text-align:center;">
                  <input type="checkbox"
                    onchange="updateInvoice({{ $item->id }}, 'checked', this.checked ? 1 : 0)"
                    {{ $item['checked'] ? 'checked' : '' }}
                    style="
                    /* Memperbesar ukuran kotak checkbox */
                    transform: scale(1.5); 
                    /* Menambah margin di kanan kotak untuk memisahkannya dari teks */
                    margin-right: 8px; 
                    /* Memberi sudut yang lebih halus */
                    border-radius: 4px;
                    /* Warna dasar kotak (tidak dapat diubah) */
                    accent-color: #007bff;
                ">
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
</div>


@endsection
<script>
function updateInvoice(id, field, value) {
    fetch("{{ route('superadmin.finance.updateStatus') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            id: id,
            [field]: value
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log("Updated:", data);
    })
    .catch(err => console.error(err));
}

function changeColor(selectEl) {
    if (selectEl.value === "Paid") {
        selectEl.style.color = "green";
    } else {
        selectEl.style.color = "red";
    }
}

// Set warna saat halaman di-load
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("select").forEach(sel => changeColor(sel));
});
</script>
