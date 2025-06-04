@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Tambah kategori produk</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4">
                        <a href="/kategori" class="btn-danger btn"><i class="fa-solid fa-backward"></i> Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('kategori')) is-invalid @endif" name="kategori" id="kategori" placeholder="" value="{{old('kategori')}}">
                            <label for="kategori">Kategori</label>
                            @if($errors->has('kategori')) 
                            <div class="invalid-feedback">
                                {{$errors->first('kategori')}}
                            </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah</button>
                          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection