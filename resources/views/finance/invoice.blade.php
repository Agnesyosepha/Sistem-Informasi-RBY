@extends('layouts.app')

@section('title', 'Invoice')

@section('content')
<h1><i class="fas fa-file-invoice"></i> Invoice</h1>
<p>Daftar data invoice yang sedang diproses.</p>

<div class="dashboard-card" style="margin-top:20px;">
        <h3><i class="fas fa-receipt"></i> Data Invoice</h3>

        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                 <tr style="background:#007BFF; color:white;">
                    <th style="padding:10px; text-align:left;">Tanggal Pembuat</th>
                    <th style="padding:10px; text-align:left;">No. Invoice</th>
                    <th style="padding:10px; text-align:left;">No. PPJP/No. Adendum</th>
                    <th style="padding:10px; text-align:left;">Nama Klien</th>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:center;">Status</th>
                    <th style="padding:10px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
@foreach($invoice as $item)
<tr style="border-bottom:1px solid #ddd;">
    <td style="padding:10px;">{{ $item['tanggal_pembuat'] }}</td>
    <td style="padding:10px;">{{ $item['no_invoice'] }}</td>
    <td style="padding:10px;">{{ $item['no_ppjp'] }}</td>
    <td style="padding:10px;">{{ $item['nama_klien'] }}</td>
    <td style="padding:10px;">{{ $item['pemberi_tugas'] }}</td>

    <td style="padding:10px; font-weight:600; 
        color: {{ $item['status'] == 'Disetujui' ? 'blue' : 'orange' }}">
        {{ $item['status'] }}
    </td>

    <td style="padding:10px; text-align:center;">
        <input type="checkbox"
            {{ $item['checked'] ? 'checked' : '' }}
            {{ $item['disabled'] ? 'disabled' : '' }}>
    </td>
</tr>
@endforeach
</tbody>
        </table>
    </div>


@endsection
