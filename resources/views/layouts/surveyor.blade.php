@extends('layouts.app')

@section('title', 'Surveyor')

@section('content')

    <h1><i class="fas fa-clipboard-list"></i> Dashboard Surveyor</h1>
    <p>Ringkasan aktivitas surveyor.</p>

    <div class="dashboard-cards">
       
        <a href="{{ route('surveyor.updateProyek') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-chart-line"></i> Update Proyek</h3>
                <p><strong>Ringkasan Status Proyek</strong></p>
            </div>
        </a>
        <a href="{{ route('surveyor.workingpaper') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-tasks"></i> Working Paper</h3>
                <p><strong>11 Dokumen</strong></p>
            </div>
        </a>
        <a href="{{ route('surveyor.laporanPenilaian') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-file"></i> Laporan Penilaian Final</h3>
            </div>
        </a>
        <a href="{{ route('surveyor.laporanJadwal') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card">
                <h3><i class="fas fa-calendar-check"></i> Laporan Jadwal Survey</h3>
                <p><strong>Daftar Laporan Jadwal Survey</strong></p>
            </div>
        </a>
         <a href="{{ route('surveyor.tim') }}" class="dashboard-card" style="display:block; color:inherit; text-decoration:none;">
            <h3><i class="fas fa-user"></i> Surveyor</h3>
            <p><strong>10 Staff</strong></p>
        </a>
    </div>
    
    <div class="dashboard-card" style="margin-top:30px;">
    <h3><i class="fas fa-calendar-alt"></i> Jadwal Surveyor</h3>

    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Surveyor</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Deskripsi</th>
                <th style="padding:10px; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jadwal as $j)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $j->nama_surveyor }}</td>
                    <td style="padding:10px;">{{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}</td>
                    <td style="padding:10px;">{{ $j->lokasi }}</td>
                    <td style="padding:10px;">{{ $j->deskripsi }}</td>
                    <td style="padding:10px; font-weight:600; color:{{ $j->status == 'Selesai' ? 'green' : 'orange' }};">
                        {{ $j->status }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:15px;">Belum ada jadwal</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <style>
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
        }

        .dashboard-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: 0.2s;
            min-height: 70px;        
            
            display: flex;            /* FLEXBOX */
            flex-direction: column;   /* SUSUN VERTICAL */
            justify-content: space-between; /* SUPAYA SPASI RAPI */
        }
    </style>

</div>

@endsection
