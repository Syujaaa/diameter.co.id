@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Ubah Foto toko</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4 mb-5">
                        <a href="/toko" class="btn-danger btn"><i class="fa-solid fa-backward"></i> Kembali</a>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-4 mb-3">
                            <input type="hidden" value="{{now()}}" name="tanggal">
                            <input type="hidden" id="waktu" name="waktu" class="form-control @if($errors->has('waktu')) is-invalid @endif" value="{{now()->format('H:i:s')}}" readonly>
                            @if($errors->has('waktu'))
                            <div class="invalid-feedback">
                                {{$errors->first('waktu')}}
                            </div>
                            @endif
                        </div>


                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ asset('storage/foto_toko/' . $toko->foto_toko)}}" style="width: 70px; height:70px;" class="img-preview @if($errors->has('foto')) is-invalid @endif" alt="">
                                </div>
                                <div class="col-md-7">
                                    <label for="foto">Ubah Foto Toko</label>
                                    <input type="file" name="foto" id="foto" class="form-control @if($errors->has('foto')) is-invalid @endif" onchange="previewImg()" accept="image/*">
                                    @if($errors->has('foto'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('foto')}}
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {

    });
</script>
<script>
    function previewImg() {
        var input = document.getElementById('foto');
        var preview = document.querySelector('.img-preview');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection
