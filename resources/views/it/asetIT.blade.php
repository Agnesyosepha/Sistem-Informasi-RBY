@extends('layouts.app')

@section('title', 'Daftar Aset IT')

@section('content')

<h1 class="fw-bold mb-2"><i class="fas fa-database"></i> Daftar Aset IT</h1>
<p class="text-muted mb-4">Informasi lengkap mengenai aset infrastruktur IT perusahaan.</p>

<div class="asset-card">

    <table class="asset-table">
        <thead>
            <tr>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($asets as $aset)
                <tr>
                    <td>{{ $aset['nama'] }}</td>
                    <td>{{ $aset['kategori'] }}</td>
                    <td>{{ $aset['lokasi'] }}</td>
                    <td>
                        <span class="status-badge {{ $aset['status'] == 'Aktif' ? 'active' : 'inactive' }}">
                            {{ $aset['status'] }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>


<style>
body {
    background: #f5f7fb;
}

/* WRAPPER CARD */
.asset-card {
    background: #ffffff;
    padding: 24px 28px;
    border-radius: 14px;
    border: 1px solid #e5e8ef;
    box-shadow: 0 4px 12px rgba(0,0,0,0.04);
    margin-top: 25px;
}

/* TABLE */
.asset-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 15px;
}

.asset-table thead tr {
    background: linear-gradient(to right, #2e63d3, #4b88ff);
    color: #ffffff;
}

.asset-table th {
    padding: 14px 12px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
    letter-spacing: 0.3px;
}

.asset-table td {
    padding: 12px 12px;
    border-bottom: 1px solid #edf0f5;
    color: #3c3f45;
}

/* STRIPED ROWS */
.asset-table tbody tr:nth-child(odd) {
    background: #f9fbff;
}

/* HOVER ROW */
.asset-table tbody tr:hover {
    background: #eef3ff;
    transition: .2s;
}

/* STATUS BADGE */
.status-badge {
    padding: 6px 12px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 600;
}

.status-badge.active {
    background: #e6f6ea;
    color: #1f9c4d;
}

.status-badge.inactive {
    background: #ffecec;
    color: #d64545;
}
</style>

@endsection
