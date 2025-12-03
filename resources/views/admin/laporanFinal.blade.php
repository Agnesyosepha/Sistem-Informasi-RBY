@extends('layouts.app')

@section('title', 'Laporan Final')

@section('content')
    <h1><i class="fas fa-book"></i> Buku Laporan Final</h1>
    <p>Daftar laporan akhir penilaian berdasarkan status pengiriman.</p>

    <form method="GET" action="{{ route('admin.laporanFinal') }}" style="margin-bottom:20px; margin-top:20px;">

        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari..."
            style="padding:8px; width:350px; border:1px solid #ccc; border-radius:6px;">

        <button type="submit" 
            style="padding:8px 15px; background:#e89746; color:black; border:none; border-radius:6px; cursor:pointer;">
            Filter
        </button>

        @if(request('search'))
        <a href="{{ route('admin.laporanFinal') }}" 
            style="padding:8px 15px; background:#777; color:white; border-radius:6px; margin-left:5px; text-decoration:none; display:inline-block;">
            Reset
        </a>
        @endif
    </form>

    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#F9B572; color:black;">
            <tr>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Jenis Penilaian</th>
                <th style="padding:10px; text-align:left;">Nama Pengirim</th>
                <th style="padding:10px; text-align:left;">No. Laporan</th>
                <th style="padding:10px; text-align:left;">Status Pengiriman</th>
                <th style="padding:10px; text-align:center;">Copy</th>
            </tr>
        </thead>

        <tbody>
            @foreach($laporanFinal as $item)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $item['pemberi_tugas'] }}</td>
                <td style="padding:10px;">{{ $item['jenis_penilaian'] }}</td>
                <td style="padding:10px;">{{ $item['pengirim'] }}</td>
                <td style="padding:10px;">{{ $item['nomor_laporan'] }}</td>

                <td style="padding:10px; font-weight:600;
                    color:
                    {{ $item['status_pengiriman'] == 'Sudah Dikirim' ? 'green' : 'red' }};
                    ">
                    {{ $item['status_pengiriman'] }}
                </td>

<!-- Kolom Copy -->
<td style="padding:10px; text-align:center;">
    <div style="display: flex; justify-content: center; gap: 20px;">
        
        <label style="display: flex; align-items: center; color:#333; cursor: default;">
            <input 
                type="checkbox" 
                onclick="return false;" class="update-softcopy" 
                data-id="{{ $item['id'] }}"
                {{ $item['softcopy'] ? 'checked' : '' }}
                style="
                    /* Memperbesar ukuran kotak checkbox */
                    transform: scale(1.5); 
                    /* Menambah margin di kanan kotak untuk memisahkannya dari teks */
                    margin-right: 8px; 
                    /* Memberi sudut yang lebih halus */
                    border-radius: 4px; 
                    /* Warna aksen untuk Softcopy (Biru) */
                    accent-color: #007bff; 
                "
            >
            Softcopy
        </label>

        <label style="display: flex; align-items: center; color:#333; cursor: default;">
            <input 
                type="checkbox" 
                onclick="return false;" class="update-hardcopy" 
                data-id="{{ $item['id'] }}"
                {{ $item['hardcopy'] ? 'checked' : '' }}
                style="
                    /* Memperbesar ukuran kotak checkbox */
                    transform: scale(1.5); 
                    /* Menambah margin di kanan kotak untuk memisahkannya dari teks */
                    margin-right: 8px; 
                    /* Memberi sudut yang lebih halus */
                    border-radius: 4px;
                    /* Warna aksen untuk Hardcopy (Hijau) */
                    accent-color: #28a745;
                "
            >
            Hardcopy
        </label>
        
    </div>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    
@endsection
