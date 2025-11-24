@extends('layouts.app')

@section('title', 'Daftar Aset IT')

@section('content')

<h1><i class="fas fa-database"></i> Daftar Aset IT</h1>
<p>Informasi lengkap mengenai aset infrastruktur IT perusahaan.</p>

<div class="dashboard-card" style="margin-top:25px;">
    <h3><i class="fas fa-box"></i> Data Aset</h3>

    <table style="width:100%; border-collapse: collapse; margin-top:15px;">
        <thead style="background:#898AC4; color:white;">
            <tr>
                <th style="padding:12px; text-align:left;">Nama Aset</th>
                <th style="padding:12px; text-align:left;">Kategori</th>
                <th style="padding:12px; text-align:left;">Lokasi</th>
                <th style="padding:12px; text-align:left;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asets as $aset)
                <tr style="border-bottom:1px solid #e2e2e2;">
                    <td style="padding:12px;">{{ $aset['nama'] }}</td>
                    <td style="padding:12px;">{{ $aset['kategori'] }}</td>
                    <td style="padding:12px;">{{ $aset['lokasi'] }}</td>
                    <td style="padding:12px;">
                        @if($aset['status'] == 'Aktif')
                            <span style="color:#16a34a; font-weight:600;">Aktif</span>
                        @else
                            <span style="color:#dc2626; font-weight:600;">Tidak Aktif</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
