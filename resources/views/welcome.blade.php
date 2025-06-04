@extends('layout.app')
@section('content')
<style>
    .product-img:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transition: box-shadow 0.3s ease-in-out;
}
</style>
@if(!isset($_GET['kategori']) && !isset($_GET['cari']))
<div class="container-fluid" style="margin-top: 40px;">

    <div id="productCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            @if($carousel_active)
            <div class="carousel-item active">
                <img src="{{ asset('storage/carousel/' . $carousel_active->foto) }}" class="d-block w-100 product-img" alt="{{ $carousel_active->nama }}" style="height: 600px; object-fit: cover;">
            </div>
            @endif
            @foreach($carousel as $key => $c)
            @if($c->id_carousel !== $carousel_active->id_carousel)
            <div class="carousel-item">
                <img src="{{ asset('storage/carousel/' . $c->foto) }}" class="d-block w-100 product-img" alt="{{ $c->nama }}" style="height: 600px; object-fit: cover;">
            </div>
            @endif
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
@endif
<style>
    .image-text-shadow {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 24px;
        font-weight: bold;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        transition: opacity 0.3s ease;
    }

    .text-decoration-none:hover .image-text-shadow {
        opacity: 1;
    }
</style>
<style>
    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(67, 67, 67, 0.7);
        display: flex;
        border-radius: 10px;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .overlay-text {
        color: white;
        font-size: 30px;
        font-weight: bold;
    }

    .text-decoration-none:hover .image-overlay {
        opacity: 1;
    }

    .text-decoration-none:hover img {
        filter: brightness(0.7);
    }
</style>
<div class="container mt-1">
    @if(!isset($_GET['kategori']) && !isset($_GET['cari']))
    <div class="justify-content-center align-items-center row mt-5">
        @foreach($index_kategori as $i)
        {{-- <div class="col-md-4 align-items-center justify-content-center d-flex mt-5" style="position: relative;">
            <a href="/?kategori={{ $i->id_kategori }}" class="text-decoration-none" style="position: relative; display: block;">
                <img src="{{ asset('storage/foto_barang/' . $i->foto) }}" style="width: 400px; height: 300px; display: block; border-radius: 10px;" alt="">
                <div class="image-text-shadow">
                   {{ $i->kategori }}
                </div>
            </a>
        </div> --}}

        <div class="col-md-4 align-items-center justify-content-center d-flex mt-5" style="position: relative;">
            <a href="/?kategori={{ $i->id_kategori }}" class="text-decoration-none" style="position: relative; display: block;">
                <img src="{{ asset('storage/foto_barang/' . $i->foto) }}" style="width: 100%; height: 100%; display: block; border-radius: 10px; transition: filter 0.3s ease;" alt="">
                <div class="image-overlay">
                    <span class="overlay-text">Cari</span>
                </div>
                <div class="image-text-shadow">
                    {{ $i->kategori }}
                </div>
            </a>
        </div>
    @endforeach

    </div>
    <hr>
    @endif
    <div class="justify-content-center align-items-center row mt-3 mt-5">
        @if($barang->isEmpty())
        <div class="d-flex justify-content-center align-items-center vh-100">
            @if(isset($_GET['cari']))
            <h1>Produk "{{ $_GET['cari'] }}" Tidak ditemukan</h1>
            @else
            <h1>Produk Tidak ditemukan</h1>
            @endif
        </div>
        @else
        @if(isset($_GET['kategori']) && $_GET['kategori'] == 'Cari toko')
        <style>
            .product-link {
                text-decoration: none;
                color: inherit;
            }

            .product-link:hover .text-muted {
                color: #000;
            }

            .product-card {
                position: relative;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .product-card img {
                transition: transform 0.3s ease;
            }

            .product-card:hover {
                transform: scale(1.05);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                border-radius: 50px;
            }

            .product-card:hover img {
                transform: scale(1.1);
            }
        </style>
        @foreach($barang as $b)
        <div class="col-md-4 mt-5">
            <a href="/toko/{{$b->id_toko}}" class="text-decoration-none product-link">
                <div class="product-card">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('storage/foto_toko/' . $b->foto_toko) }}" style="width: 290px; height:290px;">
                    </div>
                    <div class="text-center">
                        <h4 class="text-muted">{{ $b->nama_toko }}</h4>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        @else
        <style>
            .card {
                box-shadow: 6px 6px 12px 0px rgba(0, 0, 0, 0.3);
            }

            .product-link {
                position: relative;
                display: block;
                overflow: hidden;
            }

            .product-img {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .product-link:hover .product-img {
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            }

            .overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                display: flex;
                justify-content: center;
                align-items: center;
                opacity: 0;
                transition: opacity 0.3s ease;
                border-radius: 4px;
            }

            .product-link:hover .overlay {
                opacity: 1;
            }

            .overlay .text {
                font-size: 1.5rem;
                font-weight: bold;
            }
        </style>
        @foreach($barang as $b)
        <div class="col-md-4 mt-5">
            <a href="/produk/{{$b->id_produk}}" class="text-decoration-none product-link">
                <div class="card p-3 position-relative">
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/foto_barang/' . $b->foto_1) }}" class="d-block w-100 product-img" alt="..." style="border-radius: 4px;">
                    </div>
                    @if(isset($b->foto_2))
                    <div class="carousel-item">
                        <img src="{{ asset('storage/foto_barang/' . $b->foto_2) }}" class="d-block w-100 product-img" alt="..." style="border-radius: 4px;">
                    </div>
                    @endif
                    @if(isset($b->foto_3))
                    <div class="carousel-item">
                        <img src="{{ asset('storage/foto_barang/' . $b->foto_3) }}" class="d-block w-100 product-img" alt="..." style="border-radius: 4px;">
                    </div>
                    @endif
                    <div class="overlay">
                        <div class="text">Lihat Selengkapnya</div>
                    </div>
                    <h3 class="mt-2">{{ $b->nama_produk }}</h3>
                    <h4 class="text-danger">Rp {{ number_format($b->harga, 0, ',', '.') }}</h4>
                    <h6>Kategori: {{ $b->kategori }} <br>
                        Ukuran: {{ $b->ukuran }} CM</h6>
                </div>
            </a>
        </div>
        @endforeach
        @endif
        {!! $barang->appends(Request::except('page'))->links('pagination::bootstrap-5') !!}
        @endif
    </div>
</div>

@endsection
