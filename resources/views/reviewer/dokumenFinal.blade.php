@extends('layouts.app')

@section('title', 'Dokumen Final')

@section('content')
<h1><i class="fas fa-check-circle"></i> Dokumen Final</h1>
<p>Daftar dokumen yang telah selesai direvisi.</p>

<div class="dashboard-card" style="margin-top:30px;">
  <table style="width:100%; border-collapse:collapse; background:white;">
      <thead style="background:#ABE7B2;">
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
          @forelse($dokumenFinal as $data)
          <tr style="border-bottom:1px solid #ddd;">
              <td style="padding:10px;">{{ $data->tanggal }}</td>
              <td style="padding:10px;">{{ $data->jenis }}</td>
              <td style="padding:10px;">{{ $data->pemberi }}</td>
              <td style="padding:10px;">{{ $data->pengguna }}</td>
              <td style="padding:10px;">{{ $data->surveyor }}</td>
              <td style="padding:10px;">{{ $data->lokasi }}</td>
              <td style="padding:10px;">{{ $data->objek }}</td>
              <td style="padding:10px;">{{ $data->reviewer }}</td>
              <td style="padding:10px; font-weight:600; color:green;">Selesai</td>
          </tr>
          @empty
          <tr>
              <td colspan="9" style="text-align:center; padding:18px;">
                  Belum ada dokumen final.
              </td>
          </tr>
          @endforelse
      </tbody>
  </table>
</div>

@endsection
