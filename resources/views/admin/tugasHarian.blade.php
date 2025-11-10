@extends('layouts.app')

@section('title', 'Tugas Harian')

@section('content')
    <h1><i class="fas fa-tasks"></i> Tugas Harian</h1>
    <p>Daftar tugas harian dari setiap role dalam sistem.</p>

  <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                <th style="padding:10px; text-align:left;">Debitur</th>
                <th style="padding:10px; text-align:left;">No.PPJP</th>
                <th style="padding:10px; text-align:left;">Tanggal Survei</th>
                <th style="padding:10px; text-align:left;">Tim Lapangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tugasHarian as $tugas)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $tugas['pemberitugas'] }}</td>
                    <td style="padding:10px;">{{ $tugas['debitur'] }}</td>
                    <td style="padding:10px;">{{ $tugas['noppjp'] }}</td>
                    <td style="padding:10px;">{{ $tugas['tanggal'] }}</td>
                    <td style="padding:10px;">{{ $tugas['timlapangan'] }}</td>
                    <td style="padding:10px; text-align:center; font-weight:600;">
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
