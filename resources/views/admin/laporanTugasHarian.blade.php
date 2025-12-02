@extends('layouts.app')

@section('title', 'Laporan Tugas Harian')

@section('content')
    <h1><i class="fas fa-tasks"></i> Laporan Tugas Harian</h1>
    <p>Daftar laporan tugas harian yang telah diselesaikan.</p>

    <div class="dashboard-card" style="margin-top:30px;">
        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#F9B572; color:black;">
                <tr>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">No. PPJP</th>
                    <th style="padding:10px; text-align:left;">Tanggal Survei</th>
                    <th style="padding:10px; text-align:left;">Tim Lapangan</th>
                    <th style="padding:10px; text-align:left;">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tugasFinal as $tugas)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $tugas->pemberi_tugas }}</td>
                    <td style="padding:10px;">{{ $tugas->debitur }}</td>
                    <td style="padding:10px;">{{ $tugas->no_ppjp }}</td>
                    <td style="padding:10px;">{{ $tugas->tanggal_survei }}</td>
                    <td style="padding:10px;">{{ $tugas->tim_lapangan }}</td>
                    <td style="padding:10px; font-weight:600; color: {{ $tugas->status == 'Selesai' ? 'green' : 'red' }}">
                        {{ $tugas->status }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:15px; text-align:center; color:#777;">
                        Belum ada laporan tugas harian.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
