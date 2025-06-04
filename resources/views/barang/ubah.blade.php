@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-2">
                    <h1>Ubah Produk</h1>
                </div>
                <div class="card-body p-5">
                    <div class="mb-4">

                        <a href="/produk" class="btn btn-outline-danger"><i class="fa-solid fa-backward"></i> Kembali</a>
                    </div>
                <form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-floating mb-3">
        <input type="text" class="form-control @if($errors->has('nama')) is-invalid @endif" name="nama" id="nama" placeholder="" value="<?php if(old('nama')){ echo old('nama'); }else{ echo $barang->nama_produk; } ?>">
        <label for="nama">Nama Produk</label>
        @if($errors->has('nama')) 
        <div class="invalid-feedback">
            {{$errors->first('nama')}}
        </div>
        @else
        <div class="invalid-feedback">
            Nama Produk harus diisi
        </div>
        @endif
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control @if($errors->has('ukuran')) is-invalid @endif" name="ukuran" id="ukuran" placeholder="" value="<?php if(old('ukuran')){ echo old('ukuran'); }else{ echo $barang->ukuran; } ?>">
        <label for="ukuran">Ukuran Produk (cm)</label>
        @if($errors->has('ukuran')) 
        <div class="invalid-feedback">
            {{$errors->first('ukuran')}}
        </div>
        @else
        <div class="invalid-feedback">
            Ukuran produk harus diisi
        </div>
        @endif
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control @if($errors->has('harga')) is-invalid @endif" name="harga" id="harga" placeholder="" value="<?php if(old('harga')){ echo old('harga'); }else{ echo $barang->harga; } ?>">
        <label for="harga">harga Produk (Rp)</label>
        @if($errors->has('harga')) 
        <div class="invalid-feedback">
            {{$errors->first('harga')}}
        </div>
        @else
        <div class="invalid-feedback">
            Harga produk harus diisi
        </div>
        @endif
    </div>

    <div class="form-floating mb-3">
    <textarea class="form-control @if($errors->has('deskripsi')) is-invalid @endif" name="deskripsi" id="deskripsi" placeholder="" style="height: 120px;"><?php if(old('deskripsi')){ echo old('deskripsi'); }else{ echo $barang->deskripsi; } ?></textarea>
    <label for="deskripsi">Deskripsi Produk</label>
    @if($errors->has('deskripsi'))
    <div class="invalid-feedback">
        {{ $errors->first('deskripsi') }}
    </div>
    @else
    <div class="invalid-feedback">
        Deskripsi produk harus diisi
    </div>
    @endif
</div>

<div class="mb-3">
        <label for="kategori">Pilih Kategori:</label>
        <select class="form-select @if($errors->has('kategori')) is-invalid @endif" id="kategori" name="kategori">
            <option value="" selected disabled hidden>Pilih...</option>
            @foreach($kategori as $k)
            <option value="{{ $k->id_kategori }}" <?php if(old('kategori')){ if(old('kategori') == $k->id_kategori){ echo 'selected'; }}else{ if($barang->id_kategori == $k->id_kategori){ echo 'selected'; } } ?>>{{$k->kategori}}</option>
            @endforeach
            
        </select>
        @if($errors->has('kategori'))
    <div class="invalid-feedback">
        {{ $errors->first('kategori') }}
    </div>
    @else
    <div class="invalid-feedback">
        Tolong pilih kategori
    </div>
    @endif
        
    </div>

    <div class="form-group mb-3">
    <div class="row">
        <div class="col-md-2">
            <img src="{{ asset('storage/foto_barang/' . $barang->foto_1) }}" style="width: 70px; height: 70px;" class=" img-preview" alt="Preview">
        </div>
        <div class="col-md-7">
            <label for="foto_1">Foto produk (utama)</label>
            <input type="file" name="foto_1" id="foto_1" class="form-control @if($errors->has('foto_1')) is-invalid @endif" onchange="previewImg('foto_1')">
            @if($errors->has('foto_1'))
            <div class="invalid-feedback">
                {{ $errors->first('foto_1') }}
            </div>
            @endif
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <div class="row">
        <div class="col-md-2">
            <img src="{{ asset('storage/foto_barang/' . $barang->foto_2) }}" style="width: 70px; height: 70px;" class=" img-preview" alt="Preview">
        </div>
        <div class="col-md-7">
            <label for="foto_2">Foto produk (kedua)</label>
            <input type="file" name="foto_2" id="foto_2" class="form-control @if($errors->has('foto_2')) is-invalid @endif" onchange="previewImg('foto_2')">
            @if($errors->has('foto_2'))
            <div class="invalid-feedback">
                {{ $errors->first('foto_2') }}
            </div>
            @endif
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <div class="row">
        <div class="col-md-2">
            <img src="{{ asset('storage/foto_barang/' . $barang->foto_3) }}" style="width: 70px; height: 70px;" class=" img-preview" alt="Preview">
        </div>
        <div class="col-md-7">
            <label for="foto_3">Foto produk (ketiga)</label>
            <input type="file" name="foto_3" id="foto_3" class="form-control @if($errors->has('foto_3')) is-invalid @endif" onchange="previewImg('foto_3')">
            @if($errors->has('foto_3'))
            <div class="invalid-feedback">
                {{ $errors->first('foto_3') }}
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
<script>
    function previewImg(inputId) {
        var input = document.getElementById(inputId);
        var preview = input.parentNode.previousElementSibling.querySelector('img'); 
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "{{ asset('storage/foto_barang/default.png') }}"; 
        }
    }
</script>

<script>
   
    document.getElementById('nama').addEventListener('input', function(){
        var nama = document.getElementById('nama');
        if(nama.value.trim() === ''){
            nama.classList.add('is-invalid');
          
        }else{
            nama.classList.remove('is-invalid');
         
        }
    })

    document.getElementById('harga').addEventListener('input', function(){
        var harga = document.getElementById('harga');
        if(harga.value.trim() === ''){
            harga.classList.add('is-invalid');
          
        }else{
            harga.classList.remove('is-invalid');
         
        }
    })

    document.getElementById('kategori').addEventListener('change', function(){
        var kategori = document.getElementById('kategori');
        if(kategori.value.trim() === ''){
            kategori.classList.add('is-invalid');
          
        }else{
            kategori.classList.remove('is-invalid');
         
        }
    })
   
    document.getElementById('ukuran').addEventListener('input', function(){
        var ukuran = document.getElementById('ukuran');
        if(ukuran.value.trim() === ''){
            ukuran.classList.add('is-invalid');
          
        }else{
            ukuran.classList.remove('is-invalid');
         
        }
    })
    document.getElementById('deskripsi').addEventListener('input', function(){
        var deskripsi = document.getElementById('deskripsi');
        if(deskripsi.value.trim() === ''){
            deskripsi.classList.add('is-invalid');
          
        }else{
            deskripsi.classList.remove('is-invalid');
         
        }
    })
</script>
@endsection