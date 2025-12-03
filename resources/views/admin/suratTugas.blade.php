@extends('layouts.app')

@section('title', 'Surat Tugas')

@section('content')
    <h1><i class="fas fa-file-signature"></i> Daftar Surat Tugas</h1>
    <p>Berikut daftar surat tugas yang telah diterbitkan untuk surveyor.</p>

    <form method="GET" action="{{ route('admin.suratTugas') }}" style="margin-bottom:20px;">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="Cari..." 
               style="padding:8px; width:250px; border:1px solid #ccc; border-radius:5px;">

        <select name="bulan" style="padding:8px; border:1px solid #ccc; border-radius:5px;">
            <option value="">-- Bulan --</option>
            @for($i=1; $i<=12; $i++)
                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                </option>
            @endfor
        </select>

        <button type="submit" 
                style="padding:8px 15px; background:#FFE082; color:black; border:none; border-radius:5px; cursor:pointer;">
            Filter
        </button>

        @if(request('search') || request('bulan'))
        <a href="{{ route('admin.suratTugas') }}" 
           style="padding:8px 15px; background:#777; color:white; border-radius:5px; margin-left:5px; text-decoration:none; display:inline-block;">
           Reset
        </a>
        @endif
    </form>

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
