@extends('layouts.app')

@section('title', 'Dokumen Revisi')

@section('content')
<h1><i class="fas fa-file-alt"></i> Dokumen Revisi</h1>
<p>Daftar dokumen yang sedang direvisi oleh tim reviewer.</p>
<form method="GET" action="{{ route('reviewer.dokumenRevisi') }}" 
      style="margin:20px 0; display:flex; gap:10px;">

    <input type="text" 
           name="search" 
           value="{{ request('search') }}" 
           placeholder="Cari ..."
           style="padding:8px; width:300px; border-radius:6px; border:1px solid #ccc;">

    <button type="submit"
        style="padding:8px 15px; background:#239BA7; color:white; border:none; border-radius:6px; cursor:pointer;">
        Search
    </button>

    @if(request('search'))
        <a href="{{ route('reviewer.dokumenRevisi') }}"
            style="padding:8px 15px; background:#6c757d; color:white; border-radius:6px; text-decoration:none;">
            Reset
        </a>
    @endif

</form>

<div class="dashboard-card" style="margin-top:30px;">
  <table style="width:100%; border-collapse: collapse; margin-top:15px; background:white; border-radius:8px; overflow:hidden;">
    <thead style="background:#239BA7; color:white;">
        <tr>
            <th style="padding:10px; text-align:left;">Tanggal</th>
            <th style="padding:10px; text-align:left;">Maksud & Tujuan</th>
            <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
            <th style="padding:10px; text-align:left;">Pengguna Laporan</th>
            <th style="padding:10px; text-align:left;">Surveyor</th>
            <th style="padding:10px; text-align:left;">Lokasi</th>
            <th style="padding:10px; text-align:left;">Objek Penilaian</th>
            <th style="padding:10px; text-align:left;">Reviewer</th>
            <th style="padding:10px; text-align:left;">Status</th>
        </tr>
    </thead>

    <tbody>
        @forelse($dokumenRevisi as $data)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:10px;">{{ $data->tanggal }}</td>
            <td style="padding:10px;">{{ $data->jenis }}</td>
            <td style="padding:10px;">{{ $data->pemberi }}</td>
            <td style="padding:10px;">{{ $data->pengguna }}</td>
            <td style="padding:10px;">{{ $data->surveyor ?? '-' }}</td>
            <td style="padding:10px;">{{ $data->lokasi ?? '-' }}</td>
            <td style="padding:10px;">{{ $data->objek ?? '-' }}</td>
            <td style="padding:10px;">{{ $data->reviewer ?? '-' }}</td>
            <td style="
                padding:10px;
                font-weight:600; 
                color:
                    @if($data->status === 'Selesai')
                        #28a745
                    @elseif($data->status === 'Dalam Revisi')
                        #ffc107
                    @else
                        #dc3545
                    @endif
            ">
                {{ $data->status }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" style="text-align:center; padding:18px; color:#777;">
                Belum ada dokumen revisi.
            </td>
        </tr>
        @endforelse
    </tbody>
  </table>
</div>
@endsection
