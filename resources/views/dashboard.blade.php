@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .hero-banner {
        width: 100%;
        height: 480px;
        background: url("{{ asset('images/kjpp.jpg') }}") center/cover no-repeat;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #000; /* Bisa diganti putih kalau mau */
        position: relative;
        margin-bottom: 30px;
    }

    /* Tambahkan overlay biar gambar tidak mengganggu teks */
    .hero-banner::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.45); /* transparan putih */
        border-radius: 12px;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-content h1 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .hero-content h3 {
        font-size: 22px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .hero-content p {
        margin: 0;
        font-size: 15px;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .hero-banner {
            height: 260px;
        }
        .hero-content h1 {
            font-size: 24px;
        }
        .hero-content h3 {
            font-size: 18px;
        }
    }
    .choose-us-section {
    text-align: center;
    margin: 60px 0;
    }

    .choose-us-title {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 30px;
    }

    .choose-box {
        max-width: 750px;
        margin: auto;
        padding: 30px;
        border-radius: 12px;
        background: #f9f9f9;
        position: relative;
        overflow: hidden;
    }

    .choose-box::before {
        content: "";
        position: absolute;
        inset: 0;
        background: url("{{ asset('images/kompetensi.jpg') }}") center/cover no-repeat;
        opacity: 0.18;
    }

    .choose-box-content {
        position: relative;
        z-index: 2;
    }

    .choose-box-icon {
        font-size: 70px;
        margin-bottom: 15px;
    }

    .choose-box-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .choose-us-section {
    text-align: center;
    margin: 70px 0;
}

.choose-us-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 50px;
}

.choose-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 35px;
    align-items: stretch;
}

.choose-box {
    padding: 30px 25px;
    border-radius: 12px;
    background: #f9f9f9;
    position: relative;
    overflow: hidden;
    min-height: 350px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.choose-box::before {
    content: "";
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0.20;
}

/* Atur gambar background masing2 box */
.choose-integritas::before {
    background-image: url("{{ asset('images/Integritas.jpg') }}");
}
.choose-kompetensi::before {
    background-image: url("{{ asset('images/kompetensi.jpg') }}");
}
.choose-profesional::before {
    background-image: url("{{ asset('images/Profesional.jpg') }}");
}

.choose-box-content {
    position: relative;
    z-index: 2;
}

.choose-box-icon {
    font-size: 60px;
    margin-bottom: 15px;
}

.choose-box-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 12px;
}

@media(max-width: 900px) {
    .choose-grid {
        grid-template-columns: 1fr;
    }
}
.office-section {
    text-align: center;
    margin: 70px 0;
}

.office-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 50px;
}

.office-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 35px;
}

.office-box h3 {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 12px;
}

.office-box p {
    margin: 3px 0;
    line-height: 1.4;
}

/* Responsive */
@media(max-width: 950px) {
    .office-grid {
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }
}

@media(max-width: 600px) {
    .office-grid {
        grid-template-columns: 1fr;
    }
}


</style>

<div class="hero-banner">
    <div class="hero-content">
        <h3>WELCOME TO</h3>
        <h1>KJPP RUDDY BARUS YENNY DAN REKAN</h1>

        <p>NIKJPP : 2.17.0144</p>
        <p>No. KMK : 728/KM.1/2022</p>
        <p>STTD OJK : STTD-PP-212/PM.223/2022</p>
        <p>ATR BPN : 1166/SK-PT.01.01/VIII/2022</p>
    </div>
</div>
<div class="choose-us-section">
    <h2 class="choose-us-title">Why Choose Us?</h2>

    <div class="choose-grid">

        <!-- INTEGRITAS -->
        <div class="choose-box choose-integritas">
            <div class="choose-box-content">
                <h3 class="choose-box-title">Integritas</h3>
                <p>
                    Bertindak dengan mengutamakan kejujuran, objektif, dapat dipercaya,
                    tidak memihak dan bertanggung jawab penuh terhadap pemberi tugas,
                    pengguna laporan dan seluruh pihak terkait lainnya.
                </p>
            </div>
        </div>

        <!-- KOMPETENSI -->
        <div class="choose-box choose-kompetensi">
            <div class="choose-box-content">
                <h3 class="choose-box-title">Kompetensi</h3>
                <p>
                    Seluruh SDM KJPP RBY memiliki syarat serta pengetahuan yang memadai,
                    baik softskill maupun hardskill, dan terus mengupdate kemampuan melalui
                    pelatihan serta kegiatan profesional terkait penilaian.
                </p>
            </div>
        </div>

        <!-- PROFESIONAL -->
        <div class="choose-box choose-profesional">
            <div class="choose-box-content">
                <h3 class="choose-box-title">Profesional</h3>
                <p>
                    Menjunjung tinggi hukum, kode etik, serta standar penilaian yang berlaku.
                    Menyampaikan hasil penilaian secara objektif dan menjaga kerahasiaan
                    seluruh pemangku kepentingan.
                </p>
            </div>
        </div>

    </div>
</div>

<div class="office-section">
    <h2 class="office-title">Our Office</h2>

    <div class="office-grid">

        <!-- Head Office -->
        <div class="office-box">
            <h3>Head Office</h3>
            <p>Jalan DI. Panjaitan No. 39 Rejosari, RT.005/013, Kel. Gilingan, Kec. Banjarsari, Surakarta, Jawa Tengah</p>
            <p>📞 0271-2921061</p>
            <p>📱 085694160999</p>
            <p>📠 0271-717672</p>
            <p>📧 adminpusat@kjpprby.com</p>
        </div>

        <!-- Bekasi Branch -->
        <div class="office-box">
            <h3>Bekasi Branch Office</h3>
            <p>Grand Galaxy City, Jl. Rose Garden Boulevard Blok RRGB No. 35, Jakasetia, Bekasi Selatan, Kota Bekasi</p>
            <p>📞 021-38711327</p>
            <p>📱 08128582445</p>
            <p>📧 adminbekasi@kjpprby.com</p>
        </div>

        <!-- Jakarta Branch -->
        <div class="office-box">
            <h3>Jakarta Branch Office</h3>
            <p>Perkantoran Ciplaz Klender, Jl. I Gusti Ngurah Rai Blok B3 No. 25, RT.008/006, Kel. Klender, Kec. Duren Sawit, Jakarta Timur</p>
            <p>📞 021-48672642</p>
            <p>📱 081385466610</p>
            <p>📧 adminjakarta@kjpprby.com</p>
        </div>

        <!-- Semarang Branch -->
        <div class="office-box">
            <h3>Semarang Branch Office</h3>
            <p>Puri Anjasmoro Blok EE 1 No. 6 – 7, Tawangsari, Semarang Barat</p>
            <p>📞 024-76434980</p>
            <p>📱 08156705690</p>
            <p>📧 adminsemarang@kjpprby.com</p>
        </div>

    </div>
</div>


@endsection
