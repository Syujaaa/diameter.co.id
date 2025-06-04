@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Ubah Users Admin</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4">
                        <a href="/Users" class="btn-danger btn"><i class="fa-solid fa-backward"></i> Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" id="name" placeholder="" value="<?php if (old('name')) {
                                                                                                                                                                echo old('name');
                                                                                                                                                            } else {
                                                                                                                                                                echo $user->nama;
                                                                                                                                                            } ?>">
                            <label for="name">Nama</label>
                            @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{$errors->first('name')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('username')) is-invalid @endif" name="username" id="username" placeholder="" value="<?php if (old('username')) {
                                                                                                                                                                            echo old('username');
                                                                                                                                                                        } else {
                                                                                                                                                                            echo $user->username;
                                                                                                                                                                        } ?>">
                            <label for="username">Username</label>
                            @if($errors->has('username'))
                            <div class="invalid-feedback">
                                {{$errors->first('username')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-5">
                            <label for="ubahPass">Ubah Password</label>
                            <select name="ubahPass" id="ubahPass" class="form-select">
                                <option value="0" <?php if (old('ubahPass') == '0') {
                                                        echo 'selected';
                                                    } ?>>Tidak</option>
                                <option value="1" <?php if (old('ubahPass') == '1') {
                                                        echo 'selected';
                                                    } ?>>Iya</option>
                            </select>
                        </div>
                        <div class="form-floating mb-3" id="f-pass">
                            <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif @if(session('pass')) is-invalid @endif" name="password" id="password" placeholder="" value="{{old('password')}}">
                            <label for="password">Password Lama</label>
                            @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{$errors->first('password')}}
                            </div>
                            @endif
                            @if(session('pass'))
                            <div class="invalid-feedback">
                                {{session('pass')}}
                            </div>
                            @endif
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-white btn position-absolute top-0 end-0 mt-2 me-2" id="lihatPassword">
                                    <i id="lihatPasswordIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-floating mb-3" id="f-passBaru">
                            <input type="password" class="form-control @if($errors->has('passwordAseli')) is-invalid @endif" name="passwordAseli" id="passwordAseli" placeholder="" value="{{old('passwordAseli')}}">
                            <label for="passwordAseli">Password Baru</label>
                            @if($errors->has('passwordAseli'))
                            <div class="invalid-feedback">
                                {{$errors->first('passwordAseli')}}
                            </div>
                            @endif
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-white btn position-absolute top-0 end-0 mt-2 me-2" id="lihatPasswordAseli">
                                    <i id="lihatPasswordIconAseli" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>


                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{asset('storage/fotoProfileAdmin/' . $user->foto)}}" style="width: 70px; height:70px;" class="rounded-circle img-preview  @if($errors->has('foto')) is-invalid @endif" alt="">
                                </div>
                                <div class="col-md-7">
                                    <label for="foto">Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control @if($errors->has('foto')) is-invalid @endif" onchange="previewImg()">
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
<script>
    $(document).ready(function() {
        $('#f-pass').hide();
        $('#f-passBaru').hide();

        if ($('#ubahPass').val() == '0') {
            $('#f-pass').hide();
            $('#f-passBaru').hide();
        } else if ($('#ubahPass').val() == '1') {
            $('#f-pass').show();
            $('#f-passBaru').show();
        }
        $('#ubahPass').change(function() {
            if ($('#ubahPass').val() == '0') {
                $('#f-pass').hide();
                $('#f-passBaru').hide();
            } else if ($('#ubahPass').val() == '1') {
                $('#f-pass').show();
                $('#f-passBaru').show();
            }
        });

        $('#lihatPassword').click(function() {
            var passwordField = $('#password');
            var icon = $('#lihatPasswordIcon');

            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                icon.removeClass('fas fa-eye').addClass('fas fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('fas fa-eye-slash').addClass('fas fa-eye');
            }
        });

        $('#lihatPasswordAseli').click(function() {
            var passwordAseliField = $('#passwordAseli');
            var iconAseli = $('#lihatPasswordIconAseli');

            if (passwordAseliField.attr('type') === 'password') {
                passwordAseliField.attr('type', 'text');
                iconAseli.removeClass('fas fa-eye').addClass('fas fa-eye-slash');
            } else {
                passwordAseliField.attr('type', 'password');
                iconAseli.removeClass('fas fa-eye-slash').addClass('fas fa-eye');
            }
        });
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
