@extends('layouts.app')

@section('title', 'Surat Tugas')

@section('content')

    <h1><i class="fas fa-file-signature"></i> Daftar Surat Tugas</h1>
    <p>Berikut daftar surat tugas yang telah diterbitkan untuk surveyor.</p>

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
                @php $no = 1; @endphp
                @foreach($suratTugas as $surat)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $no++ }}</td>
                        <td style="padding:10px;">{{ $surat['no_ppjp'] }}</td>
                        <td style="padding:10px;">{{ $surat['tanggal_survey'] }}</td>
                        <td style="padding:10px;">{{ $surat['lokasi'] ?? '-' }}</td>
                        <td style="padding:10px;">{{ $surat['objek_penilaian'] ?? '-' }}</td>
                        <td style="padding:10px;">{{ $surat['pemberi_tugas'] }}</td>
                        <td style="padding:10px;">{{ $surat['nama_penilai'] }}</td>
                        <td style="padding:10px;">{{ $surat['adendum'] ?? '-' }}</td>
                        <td style="padding:10px; text-align:center; font-weight:600;
                            color:
                                {{ $surat['status'] == 'survey' ? 'blue' :
                                ($surat['status'] == 'pending' ? 'orange' : 'black') }};">
                            {{ $surat['status'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
