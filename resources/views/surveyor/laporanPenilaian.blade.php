@extends('layouts.app')

@section('title', 'Laporan Penilaian')

@section('content')
    <h1><i class="fas fa-file-alt"></i> Laporan Penilaian-Final</h1>
    <p>Daftar laporan hasil penilaian yang telah dibuat oleh tim surveyor.</p>

    <form method="GET" action="" class="search-container"
        style="display:flex; align-items:center; gap:10px; margin:25px 0;">
        
        <div style="
            display:flex; 
            align-items:center; 
            background:#fff; 
            border:1px solid #d0d7de; 
            border-radius:8px; 
            padding:6px 12px;
            box-shadow:0 1px 2px rgba(0,0,0,0.06);
        ">
            <i class="fas fa-search" style="color:#6c757d; margin-right:8px;"></i>

            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari ..."
                style="
                    border:none; 
                    outline:none; 
                    font-size:14px; 
                    width:220px;
                ">
        </div>

        <button type="submit"
            style="
                background:#007BFF; 
                color:white; 
                border:none; 
                padding:8px 18px; 
                border-radius:8px; 
                cursor:pointer; 
                font-size:14px;
                box-shadow:0 1px 3px rgba(0,0,0,0.15);
                transition:0.2s;
            "
            onmouseover="this.style.background='#0069d9'"
            onmouseout="this.style.background='#007BFF'">
            Cari
        </button>

        @if(request()->has('search'))
            <a href="{{ url()->current() }}"
                style="
                    background:#6c757d; 
                    color:white; 
                    padding:8px 18px; 
                    border-radius:8px; 
                    text-decoration:none; 
                    font-size:14px;
                    box-shadow:0 1px 3px rgba(0,0,0,0.15);
                    transition:0.2s;
                "
                onmouseover="this.style.background='#5a6268'"
                onmouseout="this.style.background='#6c757d'">
                Reset
            </a>
        @endif
    </form>

    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nomor LPA</th>
                <th style="padding:10px; text-align:left;">Nama Debitur</th>
                <th style="padding:10px; text-align:left;">Objek penilaian</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:left;">Tanggal Laporan</th>
                <th style="padding:10px; text-align:center;">Softcopy</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanPenilaian as $laporan)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $laporan['nomor_laporan'] }}</td>
                    <td style="padding:10px;">{{ $laporan['klien'] }}</td>
                    <td style="padding:10px;">{{ $laporan['jenis_aset'] }}</td>
                    <td style="padding:10px;">{{ $laporan['lokasi'] }}</td>
                    <td style="padding:10px;">{{ $laporan['tgl_laporan'] }}</td>
                    <td style="padding:10px; text-align:center;">
                        @if($laporan->softcopy)
                            <a href="{{ asset('storage/laporan/'.$laporan->softcopy) }}" target="_blank"
                            style="color:white; background:#007BFF; padding:5px 10px; border-radius:5px; text-decoration:none;">
                            PDF
                            </a>
                        @else
                            -
                        @endif
                    </td>
            @endforeach
        </tbody>
    </table>
    </div>

    
@endsection
