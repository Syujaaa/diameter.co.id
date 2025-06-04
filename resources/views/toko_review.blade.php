@extends('layout.app')
@section('content')
<style>
    .profile-header {
        text-align: center;
        padding: 50px 0;
    }
    .profile-header img {
        max-width: 200px;
        border-radius: 50%;
    }
    .store-image {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        margin-bottom: 30px;
    }
    .social-links a {
        margin: 0 10px;
        color: #555;
    }
    .social-links a:hover {
        color: #007bff;
    }
    .shiny-image {
                            position: relative;
                            display: inline-block;
                            overflow: hidden;
                        }

                        .shiny-image img {
                            width: 11.5vh;
                            height: 11.5vh;
                            border-radius: 50%;

                        }

                        .shiny-image::after {
                            content: '';
                            position: absolute;
                            top: -50%;
                            left: -50%;
                            width: 100%;
                            height: 100%;
                            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.8), transparent);
                            transform: rotate(45deg);
                            animation: shine 3.5s infinite;

                        }

                        @keyframes shine {
                            0% {
                                top: -100%;
                                left: -100%;
                            }
                            100% {
                                top: 100%;
                                left: 100%;
                            }
                        }
                        #editLink {
    transform: translate(50%, 50%);
    z-index: 1;
}
</style>
<div class="container mt-5">
    <div class="d-flex justify-content-center">


    <div class="col-md-10">
    <div class="card mt-5 p-3">
    <div class="profile-header">
        <div class="shiny-image">
            <a href="{{ asset('storage/foto_toko/' . $toko->foto_toko) }}" data-fancybox="gallery">
                <img src="{{ asset('storage/foto_toko/' . $toko->foto_toko) }}" style="width: 18vh; height: 18vh;" alt="Foto Toko {{$toko->nama_toko}}" class="rounded-circle" id="profileImage">
            </a>
        </div>
        <h1 id="store-name">{{ $toko->nama_toko }}</h1>
        <p id="store-description">{{ $toko->deskripsi_toko }}</p>
    </div>
    <div class="container ms-5">
    <div class="row justify-content-center d-flex">

        <div class=" col-md-4 ms-5 mb-5 ml-5">
            <h3>Alamat</h3>
            <p id="store-location">{{ $toko->alamat }}</p>
        </div>
        @php
    $telp = $toko->telp;
    $prefix = substr($telp, 0, 2);

    if ($prefix === '62') {
        $formattedTelp = $telp;
    } elseif ($prefix === '+6') {
        $formattedTelp = substr_replace($telp, '', 0, 1);
    } else {
        $formattedTelp = '62' . $telp;
    }
@endphp
        <div class="ms-5 col-md-4 mb-5">
            <h3>Informasi kontak</h3>
            <a id="store-contact" href="https://api.whatsapp.com/send?phone={{ $formattedTelp }}" target="_BLANK"><i class="fa-brands fa-whatsapp"></i> {{$toko->telp}}</a>
        </div>
    </div>
    </div>
</div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@endsection
