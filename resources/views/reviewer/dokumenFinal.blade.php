@extends('layouts.app')

@section('title', 'Dokumen Final')

@section('content')
<h1><i class="fas fa-check-circle"></i> Dokumen Final</h1>
<p>Daftar dokumen yang telah selesai direvisi.</p>

<!-- Filter Section -->
<div class="filter-section" style="margin: 20px 0; display: flex; gap: 15px; align-items: center;">
    <form method="GET" action="{{ route('reviewer.dokumenFinal') }}" style="display: flex; gap: 10px; align-items: center;">
        <!-- Search Input -->
        <div style="display: flex; align-items: center; background: #fff; border: 1px solid #ddd; border-radius: 5px; padding: 5px 10px;">
            <i class="fas fa-search" style="color: #6c757d; margin-right: 8px;"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data..." style="border: none; outline: none; width: 200px;">
        </div>
        
        <!-- Month Filter -->
        <select name="bulan" style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
            <option value="">-- Semua Bulan --</option>
            @for($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                </option>
            @endfor
        </select>
        
        <button type="submit" style="background: #007bff; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
            Filter
        </button>
        
        @if(request()->has('search') || request()->has('bulan'))
            <a href="{{ route('reviewer.dokumenFinal') }}" style="background: #6c757d; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none;">
                Reset
            </a>
        @endif
    </form>
</div>

<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse:collapse; background:white;">
        <thead style="background:#ABE7B2;">
            <tr>
                <th style="padding:10px; text-align:left;">No</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Maksud & Tujuan</th>
                <th style="padding:10px; text-align:left;">Pemberi</th>
                <th style="padding:10px; text-align:left;">Pengguna</th>
                <th style="padding:10px; text-align:left;">Surveyor</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Objek</th>
                <th style="padding:10px; text-align:left;">Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($dokumenFinal as $index => $data)
            <tr style="border-bottom:1px solid #ddd; {{ $loop->odd ? 'background-color: #f9f9f9;' : '' }}">
                <td style="padding:10px;">{{ $index + 1 }}</td>
                <td style="padding:10px;">{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                <td style="padding:10px;">{{ $data->jenis }}</td>
                <td style="padding:10px;">{{ $data->pemberi }}</td>
                <td style="padding:10px;">{{ $data->pengguna }}</td>
                <td style="padding:10px;">{{ $data->surveyor }}</td>
                <td style="padding:10px;">{{ $data->lokasi }}</td>
                <td style="padding:10px;">{{ $data->objek }}</td>
                <td style="padding:10px; font-weight:600; 
                    color:
                        @if($data->status === 'Final EDP') #007bff
                        @elseif($data->status === 'Selesai') #28a745
                        @else #dc3545 @endif;">
                    {{ $data->status ?? 'Selesai' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align:center; padding:18px; background-color: #f8f9fa;">
                    <i class="fas fa-inbox" style="font-size: 24px; color: #6c757d; margin-bottom: 10px; display: block;"></i>
                    Belum ada dokumen final.
                </td>
            </tr>
            @endforelse
        </tbody>
        
        @if($dokumenFinal->count() > 0)
        <tfoot>
            <tr>
                <td colspan="9" style="padding:10px; text-align:right; background-color: #f1f1f1; font-size: 14px;">
                    Total: <strong>{{ $dokumenFinal->count() }}</strong> dokumen
                </td>
            </tr>
        </tfoot>
        @endif
    </table>
</div>

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
    font-weight: 600;
}

table tbody tr:hover {
    background-color: #f5f5f5;
    transition: background-color 0.2s ease;
}

table td {
    vertical-align: middle;
}

.status-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}

.status-selesai {
    background-color: #d4edda;
    color: #155724;
}

.status-final-edp {
    background-color: #d1ecf1;
    color: #0c5460;
}

@media (max-width: 768px) {
    .filter-section {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .dashboard-card {
        overflow-x: auto;
    }
    
    table {
        min-width: 800px;
    }
}
</style>
@endsection
