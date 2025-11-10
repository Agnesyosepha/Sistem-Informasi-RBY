@extends('layouts.app')

@section('title', 'Daftar Aset IT')

@section('content')
    <h1><i class="fas fa-database"></i> Daftar Aset IT</h1>
    <p>Informasi lengkap mengenai aset infrastruktur IT perusahaan.</p>

  <div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#007BFF; color:white;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama Aset</th>
                <th style="padding:10px; text-align:left;">Kategori</th>
                <th style="padding:10px; text-align:left;">Lokasi</th>
                <th style="padding:10px; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asets as $aset)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $aset['nama'] }}</td>
                    <td style="padding:10px;">{{ $aset['kategori'] }}</td>
                    <td style="padding:10px;">{{ $aset['lokasi'] }}</td>
                    <td style="padding:10px; text-align:center; font-weight:600;
                        color: {{ $aset['status'] == 'Aktif' ? 'green' : 'red' }};">
                        {{ $aset['status'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>

    
@endsection
