<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{$title}}</title>
  <script src="{{asset('asset/jquery-3.7.1.min.js')}}"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{asset('storage/foto_toko/' . $toko->foto_toko)}}" type="image/x-icon">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


    <script src="{{asset('asset/DataTables/dataTables.js')}}"></script>
    <script src="{{asset('asset/DataTables/dataTables.bootstrap5.js')}}"></script>
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/DataTables/DataTablesBootstrap.css')}}">
    <script src="{{asset('asset/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('asset/select2/select2.css')}}">
    <script src="{{asset('asset/select2/select2.min.js')}}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<style>
  .card {
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
    transform: translateY(0);
    transition: box-shadow 0.3s ease;
  }

  input[type="password"]::-webkit-contacts-auto-fill-button,
  input[type="password"]::-webkit-credentials-auto-fill-button {
    display: none !important;
    visibility: hidden !important;
    pointer-events: none !important;
    position: absolute !important;
    right: 0 !important;
  }

  input[type="password"]:-moz-password-eye {
    display: none;
  }

  input[type="password"]::-ms-reveal {
    display: none;
  }

  html {
    scroll-behavior: smooth;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  ::selection {
    color: #2c2c2c;
    background-color: rgb(217, 217, 217)
  }
</style>

<body style="background-color: rgb(238, 238, 238);" class="min-vh-100 d-flex flex-column">
  @if(session('login'))
  <script>
    var username = '{{ auth()->user()->nama }}';
    function successfullogout() {
      Swal.fire({

        icon: 'success',
        title: 'Berhasil Login, halo ' + username + ' selamat datang',
        confirmButtonText: 'Terima kasih',
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
  @if(auth()->check())

  <style>
    body {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: hidden;
    }
    .sidebar {
      position: fixed;
      top: 0;
      left: -250px;
      height: 100vh;
      width: 250px;
      padding-top: 20px;
      background-color: var(--bs-body-bg);
      transition: left 0.3s ease-in-out;
      z-index: 1000;
      display: flex;
      flex-direction: column;
    
    }
    .sidebar.show {
      left: 0;
    }
    .content {
      flex-grow: 1;
      padding: 20px;
      width: 100%;
    }
    .nav-link {
      position: relative;
      padding-left: 20px;
    }
    .nav-link::before {
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 5px;
      background-color: transparent;
      transition: background-color 0.3s ease-in-out;
    }
    .nav-link:hover::before, .nav-link.active::before {
      background-color: #6c757d; 
    }
    .nav-link:hover, .nav-link.active {
      background-color: #f8f9fa;
      color: #121212;
    }
  </style>
<style>
  .sidebar {
    display: flex;
    flex-direction: column;
    height: 100vh;
  }
  .nav-container {
    flex: 1;
  }
  .profile-section {
    display: flex;
    align-items: center;
    padding: 25px;
  }
  .profile-section img {
    margin-right: 10px;
  }
</style>
<style>
  .suggestions-box {
    position: absolute;
    z-index: 1000;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: calc(100% - 220px);
    left: 174px;
    
    max-height: 200px;
    overflow-y: auto;
}

  .suggestion-item {
      padding: 10px;
      cursor: pointer;
  }
  .suggestion-item:hover {
      background-color: #f0f0f0;
  }
</style>
<div class="sidebar bg-body-tertiary" id="sidebar">
  <div class="navbar-brand text-center mb-4">
    <i class="fas fa-user-shield"></i> Panel Admin
    <button type="button" class="btn-white btn" id="" onclick="hideSidebar()">
      <span class="fa-regular fa-circle-xmark"></span>
    </button>
  </div>
  <div class="nav-container">
    <ul class="nav flex-column navbar-nav ms-2">
      <li class="nav-item">
        <a class="nav-link @if($title === 'Dashboard admin') active @endif" aria-current="page" href="/">
          <i class="fas fa-home"></i> Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if(Str::contains($title, 'Admin')) active @endif" href="/Users">
          <i class="fa-solid fa-users"></i> Admin
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($title === 'Daftar Produk') active @endif" href="/produk">
          <i class="fas fa-box"></i> Products
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($title === 'Activity') active @endif" href="/activity">
          <i class="fas fa-chart-line"></i> Activity Admin
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle  @if($title === 'Pengaturan ' . $toko->nama_toko || Str::contains($title, 'kategori') ||  Str::contains($title, 'carousel') || Str::contains($title, 'Tampilan'))) active @endif" href="#" id="settingsDropdown" onclick="toggleDropdown('settingsDropdownMenu')">
          <i class="fas fa-cog"></i> Settings
        </a>
        <div class="dropdown-menu" id="settingsDropdownMenu">
          <a class="dropdown-item @if($title === 'Pengaturan ' . $toko->nama_toko) active @endif" href="/toko">
            <i class="fa-solid fa-store"></i> Toko
          </a>
          <a class="dropdown-item @if(Str::contains($title, 'carousel')) active @endif" href="/carousel">
            <i class="fa-solid fa-sliders"></i> Carousel
          </a>
          <a class="dropdown-item @if(Str::contains($title, 'kategori')) active @endif" href="/kategori">
            <i class="fa-solid fa-list"></i> Kategori
          </a>
          <a class="dropdown-item @if(Str::contains($title, 'Tampilan')) active @endif" href="/tampilan">
            <i class="fa-solid fa-clapperboard"></i> Tampilan Footer
          </a>

        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="logout()">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </div>
  <div class="profile-section ">
    <hr>
    <img src="{{asset('storage/fotoProfileAdmin/' . auth()->user()->foto)}}" style="height: 30px; width: 30px;" class="rounded-circle" alt="">
    {{auth()->user()->nama}}
  </div>
</div>

<div class="content" id="content">
  <button class="navbar-toggler" onclick="toggleSidebar()"><span class="fa-solid fa-bars"></span></button>

 @yield('content')
</div>
<style>
  .dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    border: 1px solid rgba(0, 0, 0, 0.15);
    box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }
  .dropdown-menu.show {
    display: block;
  }
</style>

<script>
  function toggleDropdown(id) {
    var element = document.getElementById(id);
    if (element.classList.contains('show')) {
      element.classList.remove('show');
    } else {
      
      var dropdowns = document.getElementsByClassName('dropdown-menu');
      for (var i = 0; i < dropdowns.length; i++) {
        dropdowns[i].classList.remove('show');
      }
      element.classList.add('show');
    }
  }

  
  window.onclick = function(event) {
    if (!event.target.matches('.dropdown-toggle')) {
      var dropdowns = document.getElementsByClassName('dropdown-menu');
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
</script>
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('show');
    }
    function hideSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.remove('show');
    }
  </script>
 
  @else
  <style>
    .suggestions-box {
      position: absolute;
      z-index: 1000;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 4px;
      width: calc(100% - 235px);
      left: 190px;
      
      max-height: 200px;
      overflow-y: auto;
  }
  
    .suggestion-item {
        padding: 10px;
        cursor: pointer;
    }
    .suggestion-item:hover {
        background-color: #f0f0f0;
    }
  </style>
  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container">
        <a href="/toko" class="navbar-brand">
            <img src="{{ asset('storage/foto_toko/' . $toko->foto_toko) }}" style="width: 20px; height: 20px;" class="rounded-circle" alt="" srcset="">
            <span id="nama_atas">{{ $toko->nama_toko }}</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#Nav" aria-controls="Nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="Nav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if($title == 'Toko SMK') active @endif" aria-current="page" href="/"><i class="fa-solid fa-house"></i> Home</a>
                </li>
            </ul>
            <form class="d-flex col-md-6 position-relative" role="search" action="/">
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
        </div>
    </div>
</nav>

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
  @yield('content')
  <br><br><br>
  <div class="mt-auto bg-body-tertiary">
      <div class="container p-4">
          <div class="row">
              <div class="col-md-6">
                  <h1>{{ $footer->header }}</h1>
              </div>
              <div class="col-md-6">
                  <div class="row">
                      <div class="col-md-4 mt-3">
                          <a class="text-decoration-none text-dark" href="{{ $footer->text1R }}" target="_BLANK">{{ $footer->text1 }}</a>
                      </div>
                      <div class="col-md-4 mt-3">
                          <a class="text-decoration-none text-dark" href="{{ $footer->text2R }}" target="_BLANK">{{ $footer->text2 }}</a>
                      </div>
                     
                      <div class="col-md-4 mt-3">
                          <a class="text-decoration-none text-dark"  href="{{ $footer->text3R }}" target="_BALNK">{{ $footer->text3 }}</a>
                      </div>
                     
                  </div>
              </div>
          </div>
      </div>
  </div>
  <footer class='bg-dark text-center text-light'>
      <br>
      <p>&copy; {{ $footer->copyRight }}</p>
  </footer>
  @endif


  <script>
    function logout() {
      Swal.fire({
        icon: 'question',
        title: 'Konfirmasi',
        text: 'Yakin ingin logout?',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = '/logout';
        }
      });

      return false;
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>