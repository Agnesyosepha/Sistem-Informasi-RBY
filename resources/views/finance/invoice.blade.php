@extends('layouts.app')

@section('title', 'Invoice')

@section('content')
<h1><i class="fas fa-file-invoice"></i> Invoice</h1>
<p></p>
<form method="GET" actionDaftar data invoice yang sedang diproses.="{{ route('finance.invoice') }}" 
      style="margin-top:20px; margin-bottom:20px; display:flex; gap:10px; align-items:center;">

    {{-- SEARCH --}}
    <input type="text" name="search" value="{{ request('search') }}"
        placeholder="Cari ..."
        style="padding:10px 15px; width:280px; border-radius:8px; border:1px solid #ccc;">

    {{-- FILTER BULAN --}}
    <select name="bulan" 
        style="padding:10px 15px; border-radius:8px; border:1px solid #ccc; width:180px;">
        <option value="">-- Pilih Bulan --</option>
        @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
            </option>
        @endfor
    </select>

    <button type="submit"
        style="padding:10px 18px; background:#007BFF; color:white; border:none; border-radius:8px; cursor:pointer; font-weight:600;">
        Filter
    </button>

    @if(request()->has('search') || request()->has('bulan'))
        <a href="{{ route('finance.invoice') }}"
            style="padding:10px 18px; background:#6c757d; color:white; border-radius:8px; text-decoration:none; font-weight:600;">
            Reset
        </a>
    @endif
</form>


<div class="dashboard-card" style="margin-top:20px;">
        <h3><i class="fas fa-receipt"></i> Data Invoice</h3>

        <table style="width:100%; border-collapse: collapse; margin-top:15px;">
            <thead style="background:#007BFF; color:white;">
                 <tr style="background:#007BFF; color:white;">
                    <th style="padding:10px; text-align:center;">No</th>
                    <th style="padding:10px; text-align:left;">Tanggal Pembuat</th>
                    <th style="padding:10px; text-align:left;">No. Invoice</th>
                    <th style="padding:10px; text-align:left;">No. PPJP/No. Adendum</th>
                    <th style="padding:10px; text-align:left;">Debitur</th>
                    <th style="padding:10px; text-align:left;">Pemberi Tugas</th>
                    <th style="padding:10px; text-align:left;">Pengguna Laporan</th>
                    <th style="padding:10px; text-align:left;">Status</th>
                    <th style="padding:10px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($invoice as $item)
              <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px; text-align:center;">
                    {{ $loop->iteration }}
                </td>

                <td style="padding:10px;">
                    {{ $item['tanggal_pembuat'] }}
                </td>
                <td style="padding:10px;">{{ $item['no_invoice'] }}</td>
                <td style="padding:10px;">{{ $item['no_ppjp'] }}</td>
                <td style="padding:10px;">{{ $item['nama_klien'] }}</td>
                <td style="padding:10px;">{{ $item['pemberi_tugas'] }}</td>
                <td style="padding:10px;">{{ $item['pengguna_laporan'] }}</td>

                <td style="padding:10px; font-weight:600;
                    color: {{ $item['status'] == 'Paid' ? 'green' : 'red' }}">
                    {{ $item['status'] }}
                </td>

                <td style="padding:10px; text-align:center;">
                  <input type="checkbox"
                  onclick="return false;" class="update-softcopy"
                  data-id="{{ $item['id'] }}"
                    {{ $item['checked'] ? 'checked' : '' }}
                    style="
                    /* Memperbesar ukuran kotak checkbox */
                    transform: scale(1.5); 
                    /* Menambah margin di kanan kotak untuk memisahkannya dari teks */
                    margin-right: 8px; 
                    /* Memberi sudut yang lebih halus */
                    border-radius: 4px; 
                    /* Warna aksen untuk Softcopy (Biru) */
                    accent-color: #007bff; 
                ">
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
</div>


@endsection
