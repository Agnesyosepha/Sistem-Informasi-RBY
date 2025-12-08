@extends('layouts.app')

@section('title', 'Finance')

@section('content')
    <h1><i class="fas fa-file-invoice-dollar"></i> Dashboard Finance</h1>
    <p>Data - data keuangan yang perlu divalidasi.</p>

    <div class="dashboard-cards">
        <a href="{{ route('finance.invoice') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-file-invoice"></i> Invoice</h3>
                <p><strong>Data Invoice</strong></p>
            </div>
        </a>
        <a href="{{ route('finance.tim') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-users"></i> Staff</h3>
                <p><strong>2 Staff</strong></p>
            </div>
        </a>
    </div>

    <div class="dashboard-card" style="margin-top:20px;">
        <h3><i class="fas fa-receipt"></i> Rencana Anggaran Biaya Survey</h3>

        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white; text-align:left;">
                <tr>
                    <th style="padding:10px; text-align:center;">No</th>
                    <th style="padding:10px;">No. PPJP</th>
                    <th style="padding:10px;">Pemberi Tugas</th>
                    <th style="padding:10px;">Lokasi</th>
                    <th style="padding:10px;">Tanggal Survey</th>
                    <th style="padding:10px;">Pelaksana Inspeksi</th>
                    <th style="padding:10px;">Total Biaya Jalan</th>
                    <th style="padding:10px;">Status</th>
                </tr>
            </thead>

       <tbody>
            <tbody>
            @foreach ($rabs as $rab)
                <tr>
                    <td style="padding:10px; text-align:center;">
                        {{ $loop->iteration }}
                    </td>

                    <td style="padding:10px;">{{ $rab->no_ppjp }}</td>
                    <td style="padding:10px;">{{ $rab->pemberi_tugas }}</td>
                    <td style="padding:10px;">{{ $rab->lokasi }}</td>

                    <td style="padding:10px;">
                        {{ \Carbon\Carbon::parse($rab->tanggal_mulai)->format('d M Y') }}
                    </td>

                    <td style="padding:10px;">
                        {{ $rab->pelaksana_inspeksi ?? $rab->pelaksana }}
                    </td>

                    <td style="padding:10px;">
                        Rp {{ number_format($rab->total_biaya, 0, ',', '.') }}
                    </td>

                    <td style="padding:10px; font-weight:bold;
                        color:
                            @if($rab->status === 'Menunggu') orange
                            @elseif($rab->status === 'Disetujui') green
                            @else red
                            @endif
                    ">
                        {{ $rab->status }}
                    </td>
                </tr>
            @endforeach
            </tbody>


        </table>
    </div>
@endsection
