{{-- @extends('layouts.app')

@section('content') --}}
<div>
<style>
    .hero {
        background: url('{{ asset('images/utama.jpg') }}') center/cover no-repeat;
        height: 70vh;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-shadow: 2px 2px 6px rgba(0,0,0,0.7);
    }

    .hero h1 {
        font-size: 3rem;
        font-weight: bold;
    }

    .category-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="hero">
    <div class="text-center">
        <h1>FashionKu</h1>
        <p class="lead">Tampil stylish dengan koleksi terbaru kami</p>
        <a href="#produk" class="btn btn-light btn-lg mt-3">Lihat Produk</a>
    </div>
</div>

<div class="container mt-5">
    <h2 class="text-center mb-4">Kategori Populer</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center p-3 category-card">
                <img src="{{ asset('images/one.jpg') }}" class="card-img-top" alt="Fashion Wanita">
                <h5 class="mt-3"></h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3 category-card">
                <img src="{{ asset('images/jaket.jpg') }}" class="card-img-top" alt="Fashion Pria">
                <h5 class="mt-3"></h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3 category-card">
                <img src="{{ asset('images/jubah.jpg') }}" class="card-img-top" alt="Aksesoris">
                <h5 class="mt-3"></h5>
            </div>
        </div>
    </div>
</div>

<div class="container my-5" id="produk">
    <h2 class="text-center mb-4">Produk Pilihan</h2>
    <div class="row g-4">
        @for ($i = 1; $i <= 8; $i++)
        <div class="col-md-3">
            <div class="card h-100">
                <img src="{{ asset('images/hitam.jpg') }}" class="card-img-top" alt="Produk Fashion">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Nama Produk {{ $i }}</h5>
                    <p class="card-text text-muted">Rp99.000</p>
                    <a href="#" class="btn btn-outline-primary mt-auto">Detail</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
</div>
{{-- @endsection --}}
