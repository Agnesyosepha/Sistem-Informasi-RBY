@extends('layouts.app')

@section('title', 'Dokumen Final')

@section('content')
<h1><i class="fas fa-check-circle"></i> Dokumen Final</h1>
<p>Daftar dokumen yang telah selesai direvisi.</p>

{{-- Filter / Search --}}
<form method="GET" action="{{ route('reviewer.dokumenFinal') }}"
      style="margin:20px 0; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">

    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ..."
        style="padding:8px; width:300px; border-radius:6px; border:1px solid #ccc;">

    <select name="bulan"
        style="padding:8px; border-radius:6px; border:1px solid #ccc;">
        <option value="">Semua Bulan</option>
        @for($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
            </option>
        @endfor
    </select>

    <button type="submit"
        style="padding:8px 15px; background:#ABE7B2; color:black; border:none; border-radius:6px;">
        Filter
    </button>

    @if(request('search') || request('bulan'))
        <a href="{{ route('reviewer.dokumenFinal') }}"
           style="padding:8px 15px; background:#6c757d; color:white; border-radius:6px; text-decoration:none;">
            Reset
        </a>
    @endif
</form>

{{-- Table --}}
<div class="dashboard-card" style="margin-top:30px;">
    <table style="width:100%; border-collapse: collapse; background:white;">
        <thead style="background:#ABE7B2; color:black;">
        <tr>
            <th style="padding:10px;">No</th>
            <th style="padding:10px;">Tanggal</th>
            <th style="padding:10px;">Maksud & Tujuan</th>
            <th style="padding:10px;">Pemberi</th>
            <th style="padding:10px;">Pengguna</th>
            <th style="padding:10px;">Surveyor</th>
            <th style="padding:10px;">Lokasi</th>
            <th style="padding:10px;">Objek</th>
            <th style="padding:10px;">Status</th>
        </tr>
        </thead>

        <tbody>
        @forelse($dokumenFinal as $index => $data)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $index + 1 }}</td>
                <td style="padding:10px;">
                    {{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}
                </td>
                <td style="padding:10px;">{{ $data->jenis }}</td>
                <td style="padding:10px;">{{ $data->pemberi }}</td>
                <td style="padding:10px;">{{ $data->pengguna }}</td>
                <td style="padding:10px;">{{ $data->surveyor }}</td>
                <td style="padding:10px;">{{ $data->lokasi }}</td>
                <td style="padding:10px;">{{ $data->objek }}</td>
                <td style="padding:10px; font-weight:600;
                    color:
                        @if($data->status === 'Selesai') #28a745
                        @elseif($data->status === 'Final EDP') #007bff
                        @else #6c757d
                        @endif;">
                    {{ $data->status ?? 'Selesai' }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align:center; padding:18px;">
                    Belum ada dokumen final.
                </td>
            </tr>
        @endforelse
        </tbody>

        @if($dokumenFinal->count() > 0)
        <tfoot>
            <tr>
                <td colspan="9"
                    style="padding:10px; text-align:right; background:#f1f1f1; font-size:14px;">
                    Total: <strong>{{ $dokumenFinal->count() }}</strong> dokumen
                </td>
            </tr>
        </tfoot>
        @endif
    </table>
</div>
@endsection
