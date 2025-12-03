@extends('layouts.app')

@section('title', 'Dokumen Revisi')

@section('content')
<h1><i class="fas fa-file-alt"></i> Dokumen Revisi</h1>
<p>Daftar dokumen yang sedang direvisi oleh reviewer.</p>

<form method="GET" action="{{ route('reviewer.dokumenRevisi') }}" 
      style="margin:20px 0; display:flex; gap:10px;">

    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ..."
        style="padding:8px; width:300px; border-radius:6px; border:1px solid #ccc;">

    <button type="submit" style="padding:8px 15px; background:#239BA7; color:white; border:none; border-radius:6px;">
        Search
    </button>

    @if(request('search'))
        <a href="{{ route('reviewer.dokumenRevisi') }}"
            style="padding:8px 15px; background:#6c757d; color:white; border-radius:6px;">
            Reset
        </a>
    @endif

</form>

<div class="dashboard-card" style="margin-top:30px;">
  <table style="width:100%; border-collapse: collapse; background:white;">
    <thead style="background:#239BA7; color:white;">
        <tr>
            <th style="padding:10px;">Tanggal</th>
            <th style="padding:10px;">Maksud & Tujuan</th>
            <th style="padding:10px;">Pemberi</th>
            <th style="padding:10px;">Pengguna</th>
            <th style="padding:10px;">Surveyor</th>
            <th style="padding:10px;">Lokasi</th>
            <th style="padding:10px;">Objek</th>
            <th style="padding:10px;">Reviewer</th>
            <th style="padding:10px;">Status</th>
        </tr>
    </thead>

    <tbody>
        @forelse($dokumenRevisi as $data)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:10px;">{{ $data->tanggal }}</td>
            <td style="padding:10px;">{{ $data->jenis }}</td>
            <td style="padding:10px;">{{ $data->pemberi }}</td>
            <td style="padding:10px;">{{ $data->pengguna }}</td>
            <td style="padding:10px;">{{ $data->surveyor }}</td>
            <td style="padding:10px;">{{ $data->lokasi }}</td>
            <td style="padding:10px;">{{ $data->objek }}</td>
            <td style="padding:10px;">{{ $data->reviewer ?? '-' }}</td>
            <td style="padding:10px; font-weight:600;
                color: {{ $data->status === 'Selesai' ? '#28a745' : '#ffc107' }}">
                {{ $data->status }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" style="text-align:center; padding:18px;">Belum ada dokumen revisi.</td>
        </tr>
        @endforelse
    </tbody>
  </table>
</div>
@endsection
