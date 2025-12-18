@extends('superadmin.app2')

@section('title', 'Dashboard Superadmin')

@section('content')

<!-- Judul -->
<h1 style="font-weight:700; font-size:28px; margin-bottom:10px; color:#0C2B4E; ">
    Dashboard Superadmin
</h1>

<p style="color:#555; margin-bottom:25px; font-family: 'Great Vibes', cursive;">
    Selamat datang kembali, Superadmin 👋
</p>

<!-- Statistik Cards -->
<div style="display:grid; grid-template-columns: repeat(auto-fit,minmax(220px,1fr)); gap:20px; margin-bottom:35px;">

    <!-- Card 1 -->
    <div style="
        background:#ffffff; 
        padding:20px; 
        border-radius:12px; 
        box-shadow:0 4px 15px rgba(0,0,0,0.08);
        border-left:6px solid #4FB7B3;
    ">
        <h3 style="margin:0; font-size:16px; font-weight:600; color:#0C2B4E;">Total User</h3>
        <p style="margin:10px 0 0; font-size:28px; font-weight:700;">128</p>
    </div>

    <!-- Card 2 -->
    <div style="
        background:#ffffff; 
        padding:20px; 
        border-radius:12px; 
        box-shadow:0 4px 15px rgba(0,0,0,0.08);
        border-left:6px solid #FFC107;
    ">
        <h3 style="margin:0; font-size:16px; font-weight:600; color:#0C2B4E;">Proses Verifikasi</h3>
        <p style="margin:10px 0 0; font-size:28px; font-weight:700;">12</p>
    </div>

    <!-- Card 3 -->
    <div style="
        background:#ffffff; 
        padding:20px; 
        border-radius:12px; 
        box-shadow:0 4px 15px rgba(0,0,0,0.08);
        border-left:6px solid #0C2B4E;
    ">
        <h3 style="margin:0; font-size:16px; font-weight:600; color:#0C2B4E;">User Baru Bulan Ini</h3>
        <p style="margin:10px 0 0; font-size:28px; font-weight:700;">24</p>
    </div>

</div>

<!-- Layout Dua Kolom -->
<div style="display:grid; grid-template-columns:2fr 1fr; gap:25px;">

    <!-- Aktivitas Terbaru -->
    <div style="
        background:white; 
        padding:20px; 
        border-radius:12px; 
        box-shadow:0 4px 15px rgba(0,0,0,0.08);
    ">
        <h2 style="font-size:20px; font-weight:600; color:#0C2B4E; margin-bottom:15px;">
            Aktivitas Terbaru
        </h2>

        <ul style="padding-left:18px; color:#444; line-height:1.7; font-size:15px;">
            <li>Admin menambahkan user baru</li>
            <li>Superadmin mengubah hak akses</li>
            <li>3 user melakukan update profil</li>
            <li>Sistem melakukan backup otomatis</li>
        </ul>
    </div>

    <!-- Pengumuman -->
    <div style="
        background:white; 
        padding:20px; 
        border-radius:12px; 
        box-shadow:0 4px 15px rgba(0,0,0,0.08);
    ">
        <h2 style="font-size:20px; font-weight:600; color:#0C2B4E; margin-bottom:15px;">
            Pengumuman
        </h2>

        <p style="font-size:15px; color:#555; line-height:1.6;">
            • Maintenance server dijadwalkan pada <b>Sabtu, 23 November</b>.<br>
            • Fitur laporan aktivitas versi 2.0 akan dirilis minggu depan.<br>
            • Mohon update data pengguna jika ada perubahan informasi.
        </p>
    </div>

</div>

@endsection
