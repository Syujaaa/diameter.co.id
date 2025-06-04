@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-5">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Login Admin</h1>
                </div>
                <div class="card-body p-5">
                @if(session('gagal'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('gagal') }}'
        });
    </script>
@endif
@if(session('logout'))
<script>
        function successfullogout() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Logout',
            });
        }
        
        successfullogout();
    </script>
@endif
@if(session('berhasil'))
<script>
        function successfullogout() {
            Swal.fire({
                icon: 'success',
                title: '{{ session("berhasil")}}',
            });
        }
        
        successfullogout();
    </script>
@endif

                    <form method="post" id="loginForm">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('username')) is-invalid @endif" name="username" id="username" placeholder="NISN/NIP">
                            <label for="username">Username</label>
                           
                            <div class="invalid-feedback">
                               Username harus diisi
                            </div>
                          
                        </div>
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" name="password" id="password" placeholder="Password">
                            <label for="password">Password</label>
                           
                            <div class="invalid-feedback">
                                Password harus diisi
                            </div>
                          
                            <button type="button" class="btn-white btn position-absolute top-0 end-0 @if($errors->has('password')) me-4 @else me-2 @endif" style="margin-top: 10px" id="lihatPassword">
                                <span id="lihatPasswordIcon" class="fas fa-eye"></span>
                            </button>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Ingatkan saya
                            </label>
                        </div>
                        

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="loginButton">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('username').addEventListener('input', function(){
        var username = document.getElementById('username');
        if(username.value.trim() === ''){
            username.classList.add('is-invalid');
        }else{
            username.classList.remove('is-invalid');
        }
    });

    document.getElementById('password').addEventListener('input', function(){
        var password = document.getElementById('password');
        var lihatPassword = document.getElementById('lihatPassword');
        if(password.value.trim() === ''){
            password.classList.add('is-invalid');
            lihatPassword.classList.remove('me-2');
            lihatPassword.classList.add('me-4');
        }else{
            password.classList.remove('is-invalid');
            lihatPassword.classList.remove('me-4');
            lihatPassword.classList.add('me-2');
        }
    })
</script>
<script>
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        var button = document.getElementById('loginButton');
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        button.disabled = true;
    });
</script>
<script>
    $(document).ready(function(){
        $('#lihatPassword').click(function(){
            if($('#password').attr('type') == 'password'){
                $('#password').attr('type', 'text');
                $('#lihatPasswordIcon').removeClass('fa-eye').addClass('fa-eye-slash')
            }else{
                $('#password').attr('type','password');
                $('#lihatPasswordIcon').removeClass('fa-eye-slash').addClass('fa-eye')
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (!localStorage.getItem("visited")) {
            Swal.fire({
                title: 'Selamat Datang!',
                text: 'Terima kasih telah mengunjungi dan mempercayai situs web PKL SMK Negeri 3 Kendal. Jika Anda memiliki saran, silakan hubungi kami.',
                icon: 'info',
                confirmButtonText: 'OK'
            });

            localStorage.setItem("visited", "true");
        }
    });
</script>
@endsection
