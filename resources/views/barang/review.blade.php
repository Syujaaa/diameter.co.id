@extends('layout.app')

@section('content')
<style>
    .product-details {
        padding: 20px;
    }

    .read-more {
        color: blue;
        cursor: pointer;
    }

    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .btn-success {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        color: #fff;
        background-color: #218838;
        border-color: #1e7e34;
        transform: scale(1.05);
    }

    .btn i {
        margin-right: 0.5rem;
    }

    #productDescription {
        white-space: pre-wrap; 
        border: 1px solid #ced4da; 
        padding: 0.375rem 0.75rem; 
        border-radius: 0.25rem; 
        background-color: #f8f9fa; 
    }

    .product-card {
        position: relative;
        overflow: hidden;
    }
    .product-link {
        text-decoration: none;
        color: inherit;
    }
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .product-card:hover .overlay {
        opacity: 1;
    }
    .overlay .text {
        font-size: 20px;
        font-weight: bold;
    }
</style>

<div class="container" style="margin-top: 100px;">
    <div class="row mt-5">
        <!-- Carousel -->
        <div class="col-md-6">
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="{{ asset('storage/foto_barang/' . $barang->foto_1) }}" data-fancybox="gallery">
                            <img src="{{ asset('storage/foto_barang/' . $barang->foto_1) }}" class="d-block w-100" alt="Foto Produk 1">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="{{ asset('storage/foto_barang/' . $barang->foto_2) }}" data-fancybox="gallery">
                            <img src="{{ asset('storage/foto_barang/' . $barang->foto_2) }}" class="d-block w-100" alt="Foto Produk 2">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="{{ asset('storage/foto_barang/' . $barang->foto_3) }}" data-fancybox="gallery">
                            <img src="{{ asset('storage/foto_barang/' . $barang->foto_3) }}" class="d-block w-100" alt="Foto Produk 3">
                        </a>
                    </div>
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

        <div class="col-md-6 product-details">
            <h2>{{ $barang->nama_produk }}</h2>
            <p class="text-muted">Kategori: {{ $barang->kategori }} <br>
                Ukuran: {{ $barang->ukuran }} CM</p>
           
            <h4 class="text-danger mt-2">Rp {{ number_format($barang->harga, 0, ',', '.') }}</h4>
            <p id="productDescription">{!! nl2br(e($barang->deskripsi)) !!}</p>
            <div class="d-flex justify-content-center">
                
            </div>
            @php
                $telp = $barang->telp;
                $prefix = substr($telp, 0, 2);

                if ($prefix === '+62' || $prefix === '62') {
                    $formattedTelp = $telp;
                } elseif ($prefix === '+6') {
                    $formattedTelp = substr_replace($telp, '', 0, 1);
                }else {
                    $formattedTelp = '62' . $telp;
                }
            @endphp

            <br>
            
            <a class="btn btn-success mt-5" id="contactSeller" target="_blank">
                <i class="fab fa-whatsapp"></i> Hubungi penjual
            </a>
           
        </div>
    </div>

    <div class="row mt-5">
        <h3>Produk Lainnya</h3>
        @foreach($produkLainnya as $b)
        <div class="col-md-4 mb-4 product-card">
            <a href="/produk/{{$b->id_produk}}" class="text-decoration-none product-link">
                <div class="card h-100">
                    <img src="{{ asset('storage/foto_barang/' . $b->foto_1) }}" class="card-img-top" alt="{{ $b->nama_produk }}">
                    <div class="card-body d-flex flex-column">
                        <div class="overlay">
                            <div class="text">Lihat Selengkapnya</div>
                        </div>
                        <h3 class="card-title">{{ $b->nama_produk }}</h3>
                        <h4 class="card-text text-danger">Rp {{ number_format($b->harga, 0, ',', '.') }}</h4>
                        <h6>Kategori: {{ $b->kategori }} <br>
                            Ukuran: {{ $b->ukuran }} CM</h6>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const descriptionElement = document.getElementById('productDescription');
        let fullText = descriptionElement.innerHTML.trim();

        const getEffectiveLength = (text) => {
            const brCount = (text.match(/<br>/g) || []).length;
            return text.length + (brCount * 10000);
        };

        const truncateText = (text, length) => {
            let truncated = text.replace(/<br>/g, ' ');
            if (truncated.length > length) {
                truncated = truncated.substring(0, length) + '...';
            }
            return truncated;
        };

        const maxLength = 90;
        let isTruncated = getEffectiveLength(fullText) > maxLength;

        if (isTruncated) {
            descriptionElement.innerHTML = truncateText(fullText, maxLength);
            const readMoreElement = createReadMoreElement();
            descriptionElement.parentNode.insertBefore(readMoreElement, descriptionElement.nextSibling);
        }

        function createReadMoreElement() {
            const readMoreElement = document.createElement('span');
            readMoreElement.id = 'readMore';
            readMoreElement.classList.add('read-more');
            readMoreElement.textContent = 'Baca Lebih Banyak';
            readMoreElement.style.cursor = 'pointer';
            readMoreElement.style.color = 'blue';
            readMoreElement.addEventListener('click', toggleDescription);
            return readMoreElement;
        }

        function toggleDescription() {
            if (isTruncated) {
                Swal.fire({
                    title: "<strong>Deskripsi " + '{{ $barang->nama_produk }}' + "</strong>",
                    html: fullText,
                    showCloseButton: true,
                    showConfirmButton: false,
                    customClass: {
                        htmlContainer: 'text-left',
                        popup: 'swal2-border',
                    },
                });
            }
        }

        const contactSellerElement = document.getElementById('contactSeller');
        const phoneNumber = "{{ $formattedTelp }}"; 
        const productName = "{{ $barang->nama_produk }}"; 
        const currentURL = window.location.href; 
        const message = `{!! $message !!}`;
        const whatsappLink = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=${encodeURIComponent(message)}`;

        contactSellerElement.href = whatsappLink;
    });
</script>
@endsection
