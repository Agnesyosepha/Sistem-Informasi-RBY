@extends('layouts.app')

@section('title', 'Dokumen Final')

@section('content')
<h1><i class="fas fa-check-circle"></i> Dokumen Final</h1>
<p>Daftar dokumen yang telah selesai direvisi dan disetujui sebagai dokumen final oleh tim reviewer.</p>

<div class="dashboard-card" style="margin-top:30px;">
  <h3><i class="fas fa-folder-open"></i> Daftar Dokumen Final</h3>

  <table style="width:100%; border-collapse:collapse; margin-top:20px; background:white; border-radius:8px; overflow:hidden;">
      <thead style="background:#ABE7B2; color:black;">
          <tr>
              <th style="padding:12px 14px; text-align:left; width:60px;">No</th>
              <th style="padding:12px 14px; text-align:left;">Nama Dokumen</th>
              <th style="padding:12px 14px; text-align:left;">Tanggal Disetujui</th>
              <th style="padding:12px 14px; text-align:left;">Reviewer</th>
              <th style="padding:12px 14px; text-align:left;">Status</th>
          </tr>
      </thead>
      <tbody>
          @forelse($dokumenFinal as $index => $d)
          <tr style="border-bottom:1px solid #e5e5e5;">
              <td style="padding:12px 14px;">{{ $index + 1 }}</td>
              <td style="padding:12px 14px;">{{ $d['nama'] }}</td>
              <td style="padding:12px 14px;">{{ $d['tanggal'] }}</td>
              <td style="padding:12px 14px;">{{ $d['reviewer'] }}</td>
              <td style="padding:10px; font-weight:600; color:green;">{{ $d['status'] }}</td>
          </tr>
          @empty
          <tr>
              <td colspan="5" style="text-align:center; padding:18px; color:#777;">Belum ada dokumen final.</td>
          </tr>
          @endforelse
      </tbody>
  </table>
</div>
@endsection
