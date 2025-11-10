@extends('layouts.app')

@section('title', 'Surat Tugas')

@section('content')
    <h1><i class="fas fa-file-signature"></i> Daftar Surat Tugas</h1>
    <p>Berikut daftar surat tugas yang telah diterbitkan untuk surveyor.</p>

    
    
    <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nomor Surat</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:left;">Penanggung Jawab</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suratTugas as $surat)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $surat['nomor'] }}</td>
                    <td style="padding:10px;">{{ $surat['tanggal'] }}</td>
                    <td style="padding:10px;">{{ $surat['penanggung_jawab'] }}</td>
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
