@extends('layouts.app')

@section('title', 'Surat Tugas')

@section('content')
<style>
    .add-btn {
        background: #007BFF;
        color: white;
        padding: 9px 16px;
        border-radius: 6px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: 0.25s;
    }

    .add-btn:hover {
        background: #2ecc71;
        transform: translateY(-1px);
    }
</style>

    <h1><i class="fas fa-file-signature"></i> Daftar Surat Tugas</h1>
    <p>Berikut daftar surat tugas yang telah diterbitkan untuk surveyor.</p>

    
    
    <div class="dashboard-card" style="margin-top:30px;">
            
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#FFE082; color:black;">
            <tr>
                <th style="padding:10px; text-align:left;">Nomor PPJP</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:center;">Nama Penilai</th>
                <th style="padding:10px; text-align:center;">Adendum</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suratTugas as $surat)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $surat['no_ppjp'] }}</td>
                    <td style="padding:10px;">{{ $surat['tanggal'] }}</td>
                    <td style="padding:10px;">{{ $surat['pemberi_tugas'] }}</td>
                    <td style="padding:10px; text-align:center;">{{ $surat['nama_penilai'] }}</td>
                    <td style="padding:10px; text-align:center;">{{ $surat['adendum'] }}</td>
                    <td style="padding:10px; text-align:center; font-weight:600;
                        color:
                            {{ $surat['status'] == 'Selesai' ? 'green' :
                            ($surat['status'] == 'Proses' ? 'orange' : 'blue') }};
                    ">
                        {{ $surat['status'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    </div>
    
@endsection
