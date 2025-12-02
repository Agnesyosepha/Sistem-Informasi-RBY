@extends('layouts.app')

@section('title', 'Surat Tugas')

@section('content')
    <h1><i class="fas fa-file-signature"></i> Daftar Surat Tugas</h1>
    <p>Berikut daftar surat tugas yang telah diterbitkan untuk surveyor.</p>

    <!-- Filter dan Pencarian -->
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('admin.suratTugas') }}" style="display: flex; gap: 10px;">
            <input type="text" name="search" placeholder="Cari berdasarkan PPJP, lokasi, atau nama penilai..." 
                   value="{{ request('search') }}" 
                   style="padding: 8px; border: 1px solid #ccc; border-radius: 5px; width: 300px;">
            <button type="submit" style="background: #007BFF; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('search'))
            <a href="{{ route('admin.suratTugas') }}" style="background: #6c757d; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; display: inline-block;">
                <i class="fas fa-times"></i> Reset
            </a>
            @endif
        </form>
        
        <!-- Form Filter Bulan -->
        <form method="GET" action="{{ route('admin.suratTugas') }}" style="display: flex; gap: 10px;">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <select name="bulan" style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="">Semua Bulan</option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                    </option>
                @endfor
            </select>
            <button type="submit" style="background: #28a745; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
                <i class="fas fa-filter"></i> Filter
            </button>
            @if(request('bulan'))
            <a href="{{ route('admin.suratTugas', ['search' => request('search')]) }}" style="background: #6c757d; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; display: inline-block;">
                <i class="fas fa-times"></i> Reset
            </a>
            @endif
        </form>
    </div>

    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#FFE082; color:black;">
                <tr>
                    <th style="padding:10px; text-align:left;">No.</th>
                    <th style="padding:10px; text-align:left;">PPJP</th>
                    <th style="padding:10px; text-align:left;">Tanggal Survey</th>
                    <th style="padding:10px; text-align:left;">Lokasi</th>
                    <th style="padding:10px; text-align:left;">Objek Penilaian</th>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:left;">Nama Penilai</th>
                    <th style="padding:10px; text-align:left;">Adendum</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suratTugas as $index => $surat)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $index + 1 }}</td>
                        <td style="padding:10px;">{{ $surat->no_ppjp }}</td>
                        <td style="padding:10px;">{{ \Carbon\Carbon::parse($surat->tanggal_survey)->format('d M Y') }}</td>
                        <td style="padding:10px;">{{ $surat->lokasi ?? '-' }}</td>
                        <td style="padding:10px;">{{ $surat->objek_penilaian ?? '-' }}</td>
                        <td style="padding:10px;">{{ $surat->pemberi_tugas }}</td>
                        <td style="padding:10px;">{{ $surat->nama_penilai }}</td>
                        <td style="padding:10px;">{{ $surat->adendum ?? '-' }}</td>
                        <td style="padding:10px; text-align:center; font-weight:600;
                            color:
                                {{ $surat->status == 'survey' ? 'blue' :
                                ($surat->status == 'pending' ? 'orange' : 'black') }};">
                            {{ $surat->status }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="padding:10px; text-align:center;">Tidak ada data surat tugas yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($suratTugas->count() > 0)
        <div style="margin-top: 15px; text-align: right; color: #6c757d;">
            Menampilkan {{ $suratTugas->count() }} dari {{ $totalSuratTugas }} data
        </div>
        @endif
    </div>

@endsection
