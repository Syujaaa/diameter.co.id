@extends('layout.app')
@section('content')
<style>
    .card:hover {
        box-shadow: 6px 6px 12px 0px rgba(0, 0, 0, 0.3);
        transform: translateY(-10px);
        transition: 1s;
    }
</style>
<div class="container">
    <div class="text-center mt-5">
        <h1 id="greeting">#</h1>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function getGreeting() {
                var now = new Date();
                var hours = now.getHours();
                var greeting;
    
                if (hours < 12) {
                    greeting = "Selamat Pagi";
                } else if (hours < 15) {
                    greeting = "Selamat Siang";
                } else if (hours < 18) {
                    greeting = "Selamat Sore";
                } else {
                    greeting = "Selamat Malam";
                }
    
                return greeting;
            }
    
            var userName = "{{ auth()->user()->nama }}!";
            document.getElementById('greeting').innerText = getGreeting() + " " + userName;
        });
    </script>
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-4 mt-4 mb-4">
            <a href="/Users" class="text-decoration-none">
                <div class="card">
                    <div class="card-header text-center">
                        <h1> <i class="fa-solid fa-users"></i> Daftar Admin</h1>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5>Terdapat {{ $admin }} data admin</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mt-4 mb-4">
            <a href="/produk" class="text-decoration-none">
                <div class="card">
                    <div class="card-header text-center">
                        <h1> <i class="fas fa-box"></i> Produk</h1>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5>Terdapat {{ $jumlah_produk }} data produk</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mt-4 mb-4">
            <a href="/activity" class="text-decoration-none">
                <div class="card">
                    <div class="card-header text-center">
                        <h1> <i class="fas fa-chart-line"></i> Aktivitas Admin</h1>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5>Terdapat {{ $aktivitas }} Aktivitas admin</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mt-4">
            <a href="/toko" class="text-decoration-none">
                <div class="card">
                    <div class="card-header text-center">
                        <h1> <i class="fas fa-store"></i> Toko</h1>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5>Atur data toko</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mt-4">
            <a href="/kategori" class="text-decoration-none">
                <div class="card">
                    <div class="card-header text-center">
                        <h1><i class="fa-solid fa-list"></i> Kategori</h1>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5>Terdapat {{ $jumlah_kategori }} kategori produk</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mt-4">
            <a href="/tampilan" class="text-decoration-none">
                <div class="card">
                    <div class="card-header text-center">
                        <h1><i class="fa-solid fa-clapperboard"></i> Footer</h1>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5>Atur tampilan footer</h5>
                    </div>
                </div>
            </a>
        </div>

</div>
</div>
@endsection