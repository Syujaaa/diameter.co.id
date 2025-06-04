@extends('layout.app')
@section('content')
@if(session('berhasil'))
<script>
        function berhasil() {
            Swal.fire({
                icon: 'success',
                title: '{{ session("berhasil")}}',
            });
        }
        
        berhasil();
    </script>
@endif
<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Carousel</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('carousel.update') }}" method="POST" enctype="multipart/form-data" id="carouselForm">
                        @csrf
                        @foreach($carousel as $index => $c)
                        <div class="form-group mb-3 card p-2">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($c->foto != null)
                                    <a href="{{ asset('storage/carousel/' . $c->foto) }}" data-fancybox="gallery">
                                        <img src="{{ asset('storage/carousel/' . $c->foto) }}" style="width: 200px; height: 150px;" class="img-preview" alt="Preview">
                                    </a>
                                    @else
                                    <a href="{{ asset('storage/carousel/default.png') }}" data-fancybox="gallery">
                                        <img src="{{ asset('storage/carousel/default.png') }}" style="width: 200px; height: 150px;" class="img-preview" alt="Preview">
                                    </a>
                                    @endif
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label for="foto_{{ $index }}">Ubah Foto</label>
                                    <input type="file" name="foto_{{ $index }}" id="foto_{{ $index }}" class="form-control @if($errors->has('foto_' . $index)) is-invalid @endif" onchange="previewImg('foto_{{ $index }}')">
                                    @if($errors->has('foto_' . $index))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('foto_' . $index) }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-2 mt-5">
                                    <div class="form-check">
                                        <input class="form-check-input utama-checkbox" type="checkbox" name="utama" value="{{ $index }}" id="utama_{{ $index }}" @if($c->utama == '1') checked @endif onchange="checkUtama(this)">
                                        <label class="form-check-label" for="utama_{{ $index }}">
                                          Utama
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="status_{{ $index }}" value="1" id="status_{{ $index }}" @if($c->status == '1' || $c->utama == '1') checked @endif>
                                        <label class="form-check-label" for="status_{{ $index }}">
                                          Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="d-flex justify-content-end" id="submitButtonContainer" style="display: none;">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const initialFormState = new FormData(document.getElementById('carouselForm'));

    function previewImg(inputId) {
        const input = document.getElementById(inputId);
        const preview = input.parentNode.previousElementSibling.querySelector('img');

        const file = input.files[0];
        const reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "{{ asset('storage/foto_barang/default.png') }}"; 
        }

        showSubmitButton();
    }

    function checkUtama(selectedCheckbox) {
        if (!selectedCheckbox.checked) {
            // Prevent unchecking
            selectedCheckbox.checked = true;
            return;
        }

        document.querySelectorAll('.utama-checkbox').forEach(checkbox => {
            if (checkbox !== selectedCheckbox) checkbox.checked = false;
        });

        // When 'Utama' checkbox is checked, also update 'Aktif' checkbox
        const index = selectedCheckbox.value;
        const statusCheckbox = document.getElementById('status_' + index);
        statusCheckbox.checked = selectedCheckbox.checked;

        showSubmitButton();
    }

    function showSubmitButton() {
        const currentFormState = new FormData(document.getElementById('carouselForm'));
        const formChanged = Array.from(currentFormState.entries()).some(([key, value]) => initialFormState.get(key) !== value);

        if (formChanged) {
            document.getElementById('submitButtonContainer').style.display = 'block';
        } else {
            document.getElementById('submitButtonContainer').style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('carouselForm').addEventListener('change', showSubmitButton);
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

@endsection
