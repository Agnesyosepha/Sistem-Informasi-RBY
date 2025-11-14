@extends('layouts.app')

@section('title', 'Total Komputer')

@section('content')

<h1 class="fw-bold mb-2"><i class="fas fa-computer"></i> Daftar Komputer</h1>
<p class="text-muted mb-4">Berikut daftar komputer yang digunakan oleh staf perusahaan.</p>

<div class="pc-card">

    <table class="pc-table">
        <thead>
            <tr>
                <th>Nama Komputer</th>
                <th>Pengguna</th>
                <th>Lokasi</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($komputers as $pc)
                <tr>
                    <td>{{ $pc['nama'] }}</td>
                    <td>{{ $pc['pengguna'] }}</td>
                    <td>{{ $pc['lokasi'] }}</td>
                    <td>
                        <span class="status-badge {{ $pc['status'] == 'Aktif' ? 'active' : 'maintenance' }}">
                            {{ $pc['status'] }}
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

/* CARD WRAPPER */
.pc-card {
    background: #ffffff;
    padding: 24px 28px;
    border-radius: 14px;
    border: 1px solid #e5e8ef;
    box-shadow: 0 4px 12px rgba(0,0,0,0.04);
    margin-top: 25px;
}

/* TABLE STYLE */
.pc-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 15px;
}

.pc-table thead tr {
    background: linear-gradient(to right, #2e63d3, #4b88ff);
    color: #ffffff;
}

.pc-table th {
    padding: 14px 12px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
}

.pc-table td {
    padding: 12px 12px;
    border-bottom: 1px solid #edf0f5;
}

/* STRIPED ROWS */
.pc-table tbody tr:nth-child(odd) {
    background: #f9fbff;
}

/* HOVER EFFECT */
.pc-table tbody tr:hover {
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

.status-badge.maintenance {
    background: #fff3e3;
    color: #d68a1f;
}
</style>

@endsection
