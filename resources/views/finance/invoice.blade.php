@extends('layouts.app')

@section('title', 'Invoice')

@section('content')
<h1><i class="fas fa-file-invoice"></i> Invoice</h1>
<p>Daftar data invoice yang sedang diproses.</p>

<form method="GET" action="{{ route('finance.invoice') }}" 
      style="margin-top:20px; margin-bottom:20px; display:flex; gap:10px; align-items:center;">

    {{-- SEARCH --}}
    <div style="
        display:flex; align-items:center; background:#fff; 
        border:1px solid #d0d7de; border-radius:8px; padding:6px 12px;
        box-shadow:0 1px 2px rgba(0,0,0,0.06);
    ">
        <i class="fas fa-search" style="color:#6c757d; margin-right:8px;"></i>
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari..."
            style="border:none; outline:none; font-size:14px; width:280px;">
    </div>

    {{-- FILTER BULAN --}}
    <select name="bulan" 
        style="padding:10px 15px; border-radius:8px; border:1px solid #ccc; width:180px;">
        <option value="">-- Pilih Bulan --</option>
        @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
            </option>
        @endfor
    </select>

    <button type="submit"
        style="padding:10px 18px; background:#007BFF; color:white; border:none; border-radius:8px; cursor:pointer; font-weight:600;">
        Filter
    </button>

    @if(request()->has('search') || request()->has('bulan'))
        <a href="{{ route('finance.invoice') }}"
            style="padding:10px 18px; background:#6c757d; color:white; border-radius:8px; text-decoration:none; font-weight:600;">
            Reset
        </a>
    @endif
</form>

<div class="dashboard-card" style="margin-top:20px;">
    <h3><i class="fas fa-receipt"></i> Data Invoice</h3>

    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr style="background:#007BFF; color:white;">
                <th style="padding:10px; text-align:left;">No</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">No. Invoice</th>
                <th style="padding:10px; text-align:left;">No. PPJP/No. Adendum</th>
                <th style="padding:10px; text-align:left;">Debitur</th>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Pengguna Laporan</th>
                <th style="padding:10px; text-align:left;">Termin</th>
                <th style="padding:10px; text-align:left;">Biaya Jasa</th>
                <th style="padding:10px; text-align:left;">Bukti DP</th>
                <th style="padding:10px; text-align:left;">Bukti Pelunasan</th>
                <th style="padding:10px; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($invoice as $index => $item)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $index + 1 }}</td>
                <td style="padding:10px;">{{ \Carbon\Carbon::parse($item->tanggal_pembuat)->format('d-m Y') }}</td>
                <td style="padding:10px;">{{ $item->no_invoice }}</td>
                <td style="padding:10px;">{{ $item->no_ppjp }}</td>
                <td style="padding:10px;">{{ $item->nama_klien }}</td>
                <td style="padding:10px;">{{ $item->pemberi_tugas }}</td>
                <td style="padding:10px;">{{ $item->pengguna_laporan }}</td>
                <td style="padding:10px;">
                    <span style="font-weight:600;
                        color:
                            {{ $item->termin == 'DP' ? '#007BFF' :
                            ($item->termin == 'DP 2' ? '#6f42c1' :
                            ($item->termin == 'Pelunasan' ? '#28a745' :
                            ($item->termin == 'Lunas' ? '#17a2b8' : 'black'))) }};">
                        {{ $item->termin }}
                    </span>
                </td>
                <td style="padding:10px;">Rp {{ number_format($item->biaya_jasa, 2, ',', '.') }}</td>
                <td style="padding:10px;">
                    <div class="file-container">
                        <!-- Bukti DP 1 -->
                        <div class="file-item">
                            @if($item->bukti_dp)
                                <a href="{{ asset('storage/' . $item->bukti_dp) }}" target="_blank" 
                                   style="color:#007BFF; text-decoration:none; display: flex; align-items: center;">
                                    <i class="fas fa-file-download"></i>
                                    <span style="margin-left: 5px;"></span>
                                </a>
                            @else
                                <span style="color:#6c757d;">-</span>
                            @endif
                        </div>
                        
                        <!-- Bukti DP 2 -->
                        <div class="file-item">
                            @if($item->bukti_dp_2)
                                <a href="{{ asset('storage/' . $item->bukti_dp_2) }}" target="_blank" 
                                   style="color:#007BFF; text-decoration:none; display: flex; align-items: center;">
                                    <i class="fas fa-file-download"></i>
                                    <span style="margin-left: 5px;"></span>
                                </a>
                            @else
                                <span style="color:#6c757d;">-</span>
                            @endif
                        </div>
                    </div>
                </td>
                <td style="padding:10px;">
                    @if($item->bukti_pelunasan)
                        <a href="{{ asset('storage/' . $item->bukti_pelunasan) }}" target="_blank" 
                           style="color:#007BFF; text-decoration:none;">
                            <i class="fas fa-file-download"></i>
                        </a>
                    @else
                        <span style="color:#6c757d;">-</span>
                    @endif
                </td>
                <td style="padding:10px;">
                    <span style="font-weight:600; 
                        color: {{ $item->status == 'Paid' ? 'green' : 'red' }};">
                        {{ $item->status }}
                    </span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
    @if($invoice->count() == 0)
    <div style="text-align:center; padding:30px; color:#6c757d;">
        <i class="fas fa-inbox" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
        Tidak ada data invoice yang tersedia.
    </div>
    @endif
</div>

@endsection

<style>
.dashboard-card {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
}

table {
    font-family: Arial, sans-serif;
}

table th {
    position: sticky;
    top: 0;
}

table tbody tr:hover {
    background-color: #f5f5f5;
}

table td {
    vertical-align: middle;
}

.file-container {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.file-item {
    display: flex;
    align-items: center;
}

@media (max-width: 768px) {
    .dashboard-card {
        overflow-x: auto;
    }
    
    table {
        min-width: 1200px;
    }
}
</style>
