@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    body {
        background: linear-gradient(to bottom, #f0f4f8, #ffffff);
    }

    .layout-two-col {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 35px;
        margin-bottom: 50px;
    }

    @media(max-width: 900px) {
        .layout-two-col {
            grid-template-columns: 1fr;
        }
    }

    .left-box, .right-box {
        background: #ffffff;
        padding: 35px;
        border-radius: 18px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        position: relative;
    }

    .left-box::before {
        content:"";
        position:absolute;
        top:0; left:0;
        width:100%; height:100%;
        background:url('{{ asset('images/home.jpg') }}');
        background-size:cover;
        background-position:center;
        opacity:0.07;
        border-radius:18px;
    }

    .left-content {
        position: relative;
        z-index: 2;
    }

    .section-divider {
        margin: 25px 0;
        border: none;
        height: 2px;
        background: linear-gradient(to right, #cbd5e1, #94a3b8, #cbd5e1);
        border-radius: 5px;
    }

    .title-accent {
        width: 55px;
        height: 5px;
        background: #d4a017;
        border-radius: 5px;
        margin-bottom: 12px;
    }

    .tugas-card {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px 20px;
    background: rgba(255,255,255,0.75);
    backdrop-filter: blur(6px);
    border-radius: 14px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    text-decoration: none;
    color: #111;
    transition: .25s ease;
    position: relative;
    overflow: hidden;
}

.tugas-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    background: rgba(255,255,255,0.95);
}

.tugas-card-icon {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    transition: .25s ease;
}

.tugas-card:hover .tugas-card-icon {
    background: #F5AFAF;
    color: white;
}

.tugas-card-title {
    font-weight: 700;
    font-size: 16px;
}

</style>

<div class="layout-two-col">

    <!-- LEFT CONTENT -->
    <div class="left-box">
        <div class="left-content">

            <div class="title-accent"></div>
            <h2 style="font-weight:800; margin-bottom:8px;">WELCOME TO</h2>
            <h3 style="font-size:26px; font-weight:700; margin-bottom:18px;">
                KJPP RUDDY BARUS YENNY DAN REKAN
            </h3>

            <div class="info-list" style="margin-bottom:20px;">
                <p>📌 NIKJPP : 2.17.0144</p>
                <p>📌 No. KMK : 728/KM.1/2022</p>
                <p>📌 STTD OJK : STTD-PP-212/PM.223/2022</p>
                <p>📌 ATR BPN : 1166/SK-PT.01.01/VIII/2022</p>
            </div>

            <hr class="section-divider">

            <h3 style="font-size:22px; font-weight:700; margin-bottom:12px;">Informasi Umum</h3>
            <p style="line-height:1.75; color:#4b5563; font-size:15px;">
                Sistem ini dirancang untuk mendukung proses kerja tim KJPP RBY dalam pengelolaan data, 
                dokumen, dan pelaporan secara lebih efisien. Gunakan menu yang tersedia untuk menjalankan 
                tugas administrasi dan operasional harian.
            </p>

        </div>
    </div>

    <!-- RIGHT CONTENT -->
    <div class="right-box">
    <h3 style="font-weight:700; margin-bottom:18px;">Tugas Harian</h3>

    <div style="display:flex; flex-direction:column; gap:14px;">
        <a href="{{ route('admin') }}" class="tugas-card">
            <div class="tugas-card-icon">👨‍💼</div>
            <div class="tugas-card-title">Admin</div>
        </a>

        <a href="{{ route('surveyor') }}" class="tugas-card">
            <div class="tugas-card-icon">🗺️</div>
            <div class="tugas-card-title">Surveyor</div>
        </a>

        <a href="{{ route('edp') }}" class="tugas-card">
            <div class="tugas-card-icon">💾</div>
            <div class="tugas-card-title">EDP</div>
        </a>

        <a href="{{ route('reviewer') }}" class="tugas-card">
            <div class="tugas-card-icon">🔍</div>
            <div class="tugas-card-title">Reviewer</div>
        </a>

        <a href="{{ route('it') }}" class="tugas-card">
            <div class="tugas-card-icon">🖥️</div>
            <div class="tugas-card-title">IT Department</div>
        </a>

    </div>
</div>

    </div>

</div>


{{-- FOOTER --}}
<footer style="
    background:#f8f9fa;
    padding:40px 10px;
    margin-top:40px;
    border-top:1px solid #e5e5e5;
">

    <div class="container">

        <h2 style="
            text-align:center;
            font-size:26px;
            font-weight:700;
            margin-bottom:30px;">
            Our Office
        </h2>

        <div class="footer-grid" style="
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap:20px;
            margin-bottom:30px;
        ">
            @php
                $offices = [
                    ['name' => 'Head Office', 'loc' => 'Jl. DI. Panjaitan No. 39, Surakarta', 'tel' => '0271-2921061', 'hp' => '085694160999', 'email' => 'adminpusat@kjpprby.com'],
                    ['name' => 'Bekasi Branch', 'loc' => 'Grand Galaxy City, Bekasi', 'tel' => '021-38711327', 'hp' => '08128582445', 'email' => 'adminbekasi@kjpprby.com'],
                    ['name' => 'Jakarta Branch', 'loc' => 'Ciplaz Klender, Jakarta Timur', 'tel' => '021-48672642', 'hp' => '081385466610', 'email' => 'adminjakarta@kjpprby.com'],
                    ['name' => 'Semarang Branch', 'loc' => 'Puri Anjasmoro, Semarang Barat', 'tel' => '024-76434980', 'hp' => '08156705690', 'email' => 'adminsemarang@kjpprby.com']
                ];
            @endphp

            @foreach($offices as $o)
            <div style="
                background:#ffffff;
                padding:18px;
                border-radius:12px;
                border:1px solid #e5e7eb;
                box-shadow:0 3px 10px rgba(0,0,0,0.05);
            ">
                <h3 style="font-size:18px; font-weight:700; margin-bottom:8px;">
                    {{ $o['name'] }}
                </h3>
                <p>📍 {{ $o['loc'] }}</p>
                <p>☎ {{ $o['tel'] }}</p>
                <p>📱 {{ $o['hp'] }}</p>
                <p>✉ {{ $o['email'] }}</p>
            </div>
            @endforeach
        </div>

        <p style="text-align:center; font-size:14px; color:#666;">
            © {{ date('Y') }} KJPP RBY – All Rights Reserved
        </p>

    </div>
</footer>

@endsection