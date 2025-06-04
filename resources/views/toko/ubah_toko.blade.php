@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex ">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Ubah Data toko</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                     <div class="mb-4">

                        <a href="/toko" class="btn btn-outline-danger"><i class="fa-solid fa-backward"></i>  Kembali</a>
                    </div>

                <form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-floating mb-3">
        <input type="text" class="form-control @if($errors->has('nama')) is-invalid @endif" name="nama" id="nama" placeholder="" value="<?php if(old('nama')){ echo old('nama'); }else{ echo $toko->nama_toko; } ?>">
        <label for="nama">Nama Toko</label>
        @if($errors->has('nama'))
        <div class="invalid-feedback">
            {{$errors->first('nama')}}
        </div>
        @else
        <div class="invalid-feedback">
            Nama toko harus diisi
        </div>
        @endif
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control @if($errors->has('telp')) is-invalid @endif" name="telp" id="telp" placeholder="" value="<?php if(old('telp')){ echo old('telp'); }else{ echo $toko->telp; } ?>">
        <label for="telp"><i class="fa-brands fa-whatsapp"></i> Telephone</label>
        @if($errors->has('telp'))
        <div class="invalid-feedback">
            {{$errors->first('telp')}}
        </div>
        @else
        <div class="invalid-feedback">
            Nomor telephone WhatsApp harus diisi
        </div>
        @endif
    </div>

    <div class="form-floating mb-3">
    <textarea class="form-control @if($errors->has('alamat')) is-invalid @endif" name="alamat" id="alamat" placeholder="" style="height: 120px;"><?php if(old('alamat')){ echo old('alamat'); }else{ echo $toko->alamat; } ?></textarea>
    <label for="alamat">Alamat toko</label>
    @if($errors->has('alamat'))
    <div class="invalid-feedback">
        {{ $errors->first('alamat') }}
    </div>
    @else
    <div class="invalid-feedback">
        alamat produk harus diisi
    </div>
    @endif
</div>

<div class="form-floating mb-3">
    <textarea class="form-control @if($errors->has('deskripsi')) is-invalid @endif" name="deskripsi" id="deskripsi" placeholder="" style="height: 120px;"><?php if(old('deskripsi')){ echo old('deskripsi'); }else{ echo $toko->deskripsi_toko; } ?></textarea>
    <label for="deskripsi">Deskripsi Toko</label>
    @if($errors->has('deskripsi'))
    <div class="invalid-feedback">
        {{ $errors->first('deskripsi') }}
    </div>
    @else
    <div class="invalid-feedback">
        Deskripsi toko harus diisi
    </div>
    @endif
</div>

<div class="form-floating mb-3">
    <textarea class="form-control @if($errors->has('pesan')) is-invalid @endif" name="pesan" id="pesan" placeholder="" style="height: 120px;"><?php if(old('pesan')){ echo old('pesan'); }else{ echo $toko->pesan; } ?></textarea>
    <label for="pesan">Template Pesan</label>
    <p>Gunakan ${NamaProduk} untuk nama produk dan gunakan ${url} untuk Link produk</p>
    @if($errors->has('pesan'))
    <div class="invalid-feedback">
        {{ $errors->first('pesan') }}
    </div>
    @else
    <div class="invalid-feedback">
        pesan toko harus diisi
    </div>
    @endif
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

    document.getElementById('nama').addEventListener('input', function(){
        var nama = document.getElementById('nama');
        if(nama.value.trim() === ''){
            nama.classList.add('is-invalid');

        }else{
            nama.classList.remove('is-invalid');

        }
    })
    document.getElementById('telp').addEventListener('input', function(){
        var telp = document.getElementById('telp');
        if(telp.value.trim() === ''){
            telp.classList.add('is-invalid');

        }else{
            telp.classList.remove('is-invalid');

        }
    });

</script>
@endsection
