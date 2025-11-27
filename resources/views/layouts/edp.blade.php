@extends('layouts.app')

@section('title', 'EDP')

@section('content')
    <h1><i class="fas fa-desktop"></i> Dashboard EDP</h1>
    <p>Ringkasan aktivitas Electronic Data Processing (EDP).</p>

    <div class="dashboard-cards">
        <a href="{{ route('edp.dataAktif') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-server"></i> Data Aktif</h3>
                <p><strong>8 Data Aktif</strong></p>
            </div>
        </a>
        <a href="{{ route('edp.dokumenFinal') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-file-archive"></i> Dokumen Final</h3>
                <p><strong>Lihat Dokumen</strong></p>
            </div>
        </a>
        
        
        <a href="{{ route('edp.tim') }}" style="text-decoration:none; color:inherit;">
                <div class="dashboard-card" style="cursor:pointer;">
                    <h3><i class="fas fa-users"></i> EDP</h3>
                    <p><strong>3 Staff</strong></p>
                </div>
        </a>

    </div>

    <!-- Tabel -->
    <div class="dashboard-card" style="margin-top:30px;">
        <h3><i class="fas fa-history"></i> Log Aktivitas</h3>
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">No. Laporan</th>
                    <th style="padding:10px; text-align:left;">Tanggal</th>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:left;">Nama Penilai</th>
                    <th style="padding:10px; text-align:left;">Nama Staff EDP</th>
                    <th style="padding:10px; text-align:left;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logAktivitas as $item)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $item['no_laporan'] }}</td>
                        <td style="padding:10px;">{{ $item['tanggal'] }}</td>
                        <td style="padding:10px;">{{ $item['pemberi_tugas'] }}</td>
                        <td style="padding:10px;">{{ $item['penilai'] }}</td>
                        <td style="padding:10px;">{{ $item['staff'] }}</td>
        
                        <td style="padding:10px; text-align:left;
                            font-weight:600; 
                            color: {{ $item['status'] == 'Selesai' ? 'blue' : 'green' }};
                            ">
                            {{ $item['status'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
