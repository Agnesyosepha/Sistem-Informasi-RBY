@extends('layouts.app')

@section('title', 'EDP')

@section('content')
    <h1><i class="fas fa-desktop"></i> Dashboard EDP</h1>
    <p style="font-family: 'Great Vibes', cursive; font-weight: bold;">Ringkasan aktivitas Electronic Data Processing (EDP).</p>

    <div class="dashboard-cards">
        {{-- Card "Data Aktif" sudah dihapus --}}
        
        <a href="{{ route('edp.laporanPenilaian') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file"></i> Laporan Penilaian Final</h3>
                <p><strong>Daftar Laporan Hasil Penilaian</strong></p>
            </div>
        </a>
        <a href="{{ route('edp.dokumenFinal') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-file-archive"></i> Dokumen Final</h3>
                <p><strong>Daftar Dokumen Final EDP</strong></p>
            </div>
        </a>
        
        
        <a href="{{ route('edp.tim') }}" style="text-decoration:none; color:inherit;">
                <div class="dashboard-card" style="cursor:pointer;">
                    <h3><i class="fas fa-users"></i> EDP</h3>
                    <p><strong>3 Staff</strong></p>
                </div>
        </a>

    </div>
    
    <!-- Tabel Data Aktif Langsung Ditampilkan Di Sini -->
    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-server"></i> Data Aktif</h3>
        <p>Daftar data aktif yang sedang diproses.</p>
        
        {{-- Form action diubah ke route('edp') --}}
        <form method="GET" action="{{ route('edp') }}" 
              style="margin:20px 0; display:flex; gap:10px; align-items:center;">

            <!-- SEARCH -->
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Cari ..."
                   style="padding:8px; width:300px; border-radius:6px; border:1px solid #ccc;">

            <!-- FILTER BULAN -->
            <select name="bulan" 
                style="padding:8px; border-radius:6px; border:1px solid #ccc;">
                <option value="">Semua Bulan</option>
                @foreach(range(1,12) as $b)
                    <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                    </option>
                @endforeach
            </select>

            <!-- BUTTON FILTER -->
            <button type="submit"
                style="padding:8px 15px; background:#239BA7; color:white; border:none; border-radius:6px; cursor:pointer;">
                Filter
            </button>

            <!-- RESET -->
            @if(request('search') || request('bulan'))
                {{-- Link reset juga diubah ke route('edp') --}}
                <a href="{{ route('edp') }}"
                   style="padding:8px 15px; background:#6c757d; color:white; border-radius:6px; text-decoration:none;">
                    Reset
                </a>
            @endif
        </form>

        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#239BA7; color:white;">
                <tr>
                    <th style="padding:10px; text-align:center;">No</th>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">Maksud & Tujuan</th>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:left;">Pengguna Laporan</th>
                    <th style="padding:10px; text-align:left;">Surveyor</th>
                    <th style="padding:10px; text-align:left;">Lokasi</th>
                    <th style="padding:10px; text-align:left;">Objek Penilaian</th>
                    <th style="padding:10px; text-align:left;">Status</th>
                </tr>
            </thead>

            <tbody>
            {{-- Pastikan variabel $dataAktif ada, dikirim dari controller --}}
            @if(isset($dataAktif))
                @foreach ($dataAktif as $data)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px; text-align:center;">
                        {{ $loop->iteration }}
                    </td>

                    <td style="padding:10px; text-align:left;">{{ $data->tanggal }}</td>
                    <td style="padding:10px; text-align:left;">{{ $data->jenis }}</td>
                    <td style="padding:10px; text-align:left;">{{ $data->pemberi }}</td>
                    <td style="padding:10px; text-align:left;">{{ $data->pengguna }}</td>

                    <td style="padding:10px; text-align:left;">
                        {{ $data->surveyor ?? '-' }}
                    </td>

                    <td style="padding:10px; text-align:left;">
                        {{ $data->lokasi ?? '-' }}
                    </td>

                    <td style="padding:10px; text-align:left;">
                        {{ $data->objek ?? '-' }}
                    </td>

                    <td style="
                        padding:10px;
                        text-align:left;
                        font-weight:600; 
                        color:
                            @if($data->status_progres === 'Selesai')
                                #28a745
                            @elseif($data->status_progres === 'Reviewer')
                                #007bff
                            @elseif($data->status_progres === 'Proses')
                                #ffc107
                            @else
                                #dc3545
                            @endif
                    ">
                        {{ $data->status_progres ?? 'Proses' }}
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" style="padding:20px; text-align:center;">Tidak ada data aktif.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection