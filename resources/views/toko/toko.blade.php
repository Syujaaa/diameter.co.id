@extends('layout.app')
@section('content')

<style>
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

#editIcon {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 3rem;
    height: 3rem;
    bottom: -12vh;
    left: -3vh;
    background-color: rgb(255, 255, 255, 0.9);
border-radius: 50%;
}

                    </style>

<div class="container">
    <div class="justify-content-center d-flex">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Data {{$toko->nama_toko}}</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                @if(session('berhasil'))
<script>
        function success() {
            Swal.fire({
                icon: 'success',
                title: '{{ session("berhasil")}}',
            });
        }

        success();
    </script>
@endif



                    @if(session('gagal'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: '{{ session('
                            gagal ') }}'
                        });
                    </script>
                    @endif
                    <div class="container mt-5">
                    <div class="mx-auto d-flex justify-content-center align-items-center position-relative">
                            <div class="shiny-image">
                                <a href="{{ asset('storage/foto_toko/' . $toko->foto_toko) }}" data-fancybox="gallery">
                                    <img src="{{ asset('storage/foto_toko/' . $toko->foto_toko) }}" style="width: 18vh; height: 18vh;" alt="Foto Toko {{$toko->nama_toko}}" class="rounded-circle" id="profileImage">
                                </a>
                            </div>
                            <a href="/toko/gantiFoto" class="text-decoration-none position-relative text-light" id="editLink">
                                <span class="position-absolute translate-middle shadow" id="editIcon" style="">
                                    <i class="fas fa-pencil-alt text-secondary"></i>
                                </span>
                            </a>
                        </div>

                        <table class="table mt-5">
                            <tbody>
                                <tr>
                                    <th scope="row">Nama Toko</th>
                                    <td>: {{$toko->nama_toko}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor telephone</th>
                                    <td>: <i class="fa-brands fa-whatsapp"></i> {{$toko->telp}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td>: {{$toko->alamat}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Deskripsi toko</th>
                                    <td>: {{$toko->deskripsi_toko}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Template Pesan</th>
                                    <td>: {{$toko->pesan}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end">

                        <div class="col-auto">
                            <a href="/toko/ubah" class="btn-outline-primary btn"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
<script>
    document.addEventListener('DOMContentLoaded', function() {

        Fancybox.bind("[data-fancybox]", {

        });
    });
</script>
@endsection
