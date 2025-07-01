@extends('layouts.app')

@section('content')
<style>
    .card-dashboard {
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;
        padding: 1.5rem;
        background: #fff;
    }

    .card-dashboard:hover {
        transform: translateY(-4px);
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #4e54c8;
        margin-bottom: 0.5rem;
    }

    .card-value {
        font-size: 1.9rem;
        font-weight: 700;
        color: #333;
    }
</style>

<div class="container">
    <h2 class="mb-4 fw-bold text-dark">📊 Dashboard</h2>
    <div class="row g-4">
        <div class="col-md-3 col-sm-6">
            <div class="card-dashboard text-center">
                <div class="card-title">👥 Pengguna</div>
                <div class="card-value">{{ $totalUsers }}</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card-dashboard text-center">
                <div class="card-title">📦 Produk</div>
                <div class="card-value">{{ $totalProduk }}</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card-dashboard text-center">
                <div class="card-title">💳 Transaksi</div>
                <div class="card-value">{{ $totalTransaksi }}</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card-dashboard text-center">
                <div class="card-title">💰 Pendapatan</div>
                <div class="card-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
