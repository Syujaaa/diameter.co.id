@extends('layout.app')
@section('content')
<style>
    .fixed-bottom-right {
        position: fixed;
        bottom: 6vh;
        right: 2vh;
        z-index: 1000;
        width: 13vh;
        height: 13vh;
        font-size: 6vh;
        background-color: rgb(223, 223, 223);
        padding: 1.5vh;
        border-radius: 50%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        animation: bounce 2s infinite;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .fixed-bottom-right:hover {
        background-color: rgb(160, 160, 160);
        animation: none;
    }

   

    .fixed-bottom-right i {
        transition: transform 0.3s ease-in-out;
    }

    .fixed-bottom-right:hover i {
        transform: scale(1.3);
    }

    .fixed-bottom-right.clicked i {
        animation: moveUp 0.5s forwards;
    }

    @keyframes moveUp {
        to {
            transform: translateY(-50px);
        }
    }

    .swal2-confirm.absen-sekarang-button {
            background-color: #b0b0b0; 
            color: white;
        }
       
</style>
<div class="container ">
<a href="/Produk/tambah" class="btn rounded-circle fixed-bottom-right" id="animatedBtn">
<i class="fa-solid fa-plus"></i>
</a>
<div class="d-flex justify-content-center align-items-center">
    <div class="col-md-10">
        <div class="card ">
            <div class="card-header text-center py-4">
                <div class="d-flex justify-content-center align-items-center">
                    <h1 class="mb-0">Daftar Produk</h1>
                </div>
            </div>
            <div class="card-body p-3">

                <div class="d-flex justify-content-center">
                    
                    <form class="d-flex col-md-6 position-relative mt-4 mb-5" role="search">
                        <div class="col-md-4">
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="" selected>Semua kategori</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id_kategori }}" {{ request('kategori') == $k->id_kategori ? 'selected' : '' }}>{{ $k->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input class="form-control me-2" type="search" placeholder="Cari" aria-label="Cari" name="cari" id="search-input" value="{{ request('cari') }}">
                        <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        <div id="suggestions-box" class="suggestions-box d-none mt-5"></div>
                    </form>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#search-input').on('input', function(){
            let query = $(this).val().trim();
            let kategori = $('#kategori').val();

            if(query.length > 0){
                $.ajax({
                    url: '/search-suggestions',
                    type: 'GET',
                    data: { query: query },
                    success: function(data){
                        let suggestionsBox = $('#suggestions-box');
                        suggestionsBox.empty();

                        if(data.length > 0){
                            data.forEach(function(item){
                                suggestionsBox.append('<div class="suggestion-item">' + item + '</div>');
                            });
                            suggestionsBox.removeClass('d-none');
                        } else {
                            suggestionsBox.addClass('d-none');
                        }
                    }
                });
            } else {
                $('#suggestions-box').addClass('d-none');
            }
        });

        $(document).on('click', '.suggestion-item', function(){
            $('#search-input').val($(this).text());
            $('#suggestions-box').addClass('d-none');
        });

        $(document).click(function(e){
            if(!$(e.target).closest('.suggestions-box, #search-input').length){
                $('#suggestions-box').addClass('d-none');
            }
        });
    });
</script>
                </div>
                @if($barang->isEmpty())
              <div class="m-5 text-center">
                <h2 class="m-5">Daftar produk kosong</h2>
              </div>
                @else

              
                <div class="justify-content-center align-items-center row">
                    @foreach($barang as $b)
                    <div class="col-md-4 mb-5">
                        <div class="card p-2">
                           
                            <div id="carousel{{ $b->id_produk }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('storage/foto_barang/' . $b->foto_1) }}" class="d-block w-100" style="height: 200px; border-radius: 4px;" alt="...">
                                    </div>
                                    @if($b->foto_2)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/foto_barang/' . $b->foto_2) }}" class="d-block w-100" style="height: 200px; border-radius: 4px;" alt="...">
                                    </div>
                                    @endif
                                    @if($b->foto_3)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/foto_barang/' . $b->foto_3) }}" class="d-block w-100" style="height: 200px; border-radius: 4px;" alt="...">
                                    </div>
                                    @endif
                                </div>
                                @if($b->foto_2 || $b->foto_3)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $b->id_produk }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $b->id_produk }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                @endif
                            </div>
                          
                            <h5 class="mt-2">{{ $b->nama_produk }}</h5>
                            <h6 class="mt-2">{{ $b->kategori }}</h6>
                            <h6>Rp {{ number_format($b->harga, 0, ',', '.') }}</h6>
                    
                            <div class="mt-3">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <button class="btn btn-danger" onclick="confirmDelete({{ $b->id_produk }})"><i class="fa-solid fa-trash"></i> Hapus</button>
                                    </div>
                                    <div class="col-auto">
                                        <a href="/produk/ubah/{{$b->id_produk}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>

@foreach($barang as $b)
<form id="delete-form-{{ $b->id_produk }}" action="{{ route('barang.destroy', $b->id_produk) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endforeach
</div>
                @endif
            </div>
            </div>
        </div>
    </div>
</div>

@endsection