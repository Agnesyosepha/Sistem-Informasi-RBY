@extends('superadmin.app2')

@section('title', 'Finance Admin')

@section('content')

<h1><i class="fas fa-file-invoice-dollar"></i> Finance Admin</h1>
    <p style="font-family: 'Great Vibes', cursive;">Data - data keuangan yang perlu divalidasi.</p>

    <div class="dashboard-cards">
        <a href="{{ route('superadmin.finance.SAinvoice') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-file-invoice"></i> Invoice</h3>
                <p><strong>Data Invoice</strong></p>
            </div>
        </a>
        {{--
        <a href="" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-users"></i> Staff</h3>
                <p><strong>Staff</strong></p>
            </div>
        </a>
        --}}
        <a href="{{ route('superadmin.rab') }}" style="text-decoration:none; color:inherit;">
            <div class="dashboard-card" style="cursor:pointer;">
                <h3><i class="fas fa-users"></i> Rencana Anggaran Biaya Survey </h3>
                <p><strong>RAB</strong></p>
            </div>
        </a>
    </div>

@endsection
