@extends('layouts.app')

@section('title', 'Proposal')

@section('content')
    <h1><i class="fas fa-lightbulb"></i> Daftar Proposal</h1>
    <p>Berikut adalah daftar proposal yang diajukan oleh para surveyor untuk penilaian aset.</p>

    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                <tr>
                    <th style="padding:10px; text-align:left;">Nama Objek</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">Tanggal Pengajuan</th>
                    <th style="padding:10px; text-align:left;">Tanggal Disetujui</th>
                    <th style="padding:10px; text-align:left;">Deadline</th>
                    <th style="padding:10px; text-align:left;">Tanggal Berakhir</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposal as $p)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:10px;">{{ $p['judul'] }}</td>
                        <td style="padding:10px;">{{ $p['pengaju'] }}</td>
                        <td style="padding:10px;">{{ $p['tanggal'] }}</td>
                        <td style="padding:10px;">{{ $p['tgl_disetujui'] }}</td>
                        <td style="padding:10px;">{{ $p['deadline'] }}</td>
                        <td style="padding:10px;">{{ $p['tgl_berakhir'] }}</td>
                        <td style="padding:10px; text-align:center; font-weight:600;
                            color:
                                {{ $p['status'] == 'Disetujui' ? 'green' :
                                   ($p['status'] == 'Menunggu Review' ? 'orange' :
                                   ($p['status'] == 'Direvisi' ? 'red' : 'blue')) }};">
                            {{ $p['status'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
