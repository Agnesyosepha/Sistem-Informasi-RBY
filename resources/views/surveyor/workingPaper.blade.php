@extends('layouts.app')

@section('title', 'Working Paper')

@section('content')
    <h1><i class="fas fa-file-alt"></i> Working Paper</h1>
    <p>Daftar dokumen working paper yang telah dibuat oleh surveyor.</p>

    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Judul Dokumen</th>
                <th style="padding:10px; text-align:left;">Tanggal</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($workingPapers as $paper)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $paper['judul'] }}</td>
                    <td style="padding:10px;">{{ $paper['tanggal'] }}</td>
                    <td style="padding:10px; text-align:center; font-weight:600;
                        color: {{ $paper['status'] == 'Selesai' ? 'green' : 'orange' }};">
                        {{ $paper['status'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
@endsection
