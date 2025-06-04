@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Daftar Admin</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if(session('berhasil'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: '{{ session('berhasil') }}',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        </script>
                    @endif
                    <div class="d-flex justify-content-end my-3">
                        <a href="/Users/Tambah" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered align-middle" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Foto</th>

                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <?php
                            $no = 1;
                            ?>
                            <tbody>
                                @foreach($users as $u)
                                    <tr>
                                        <td class="text-center">{{$no++}}</td>
                                        <td class="text-center">{{$u->nama}}</td>
                                        <td class="text-center">{{$u->username}}</td>
                                         <td class="text-center">
        <a data-fancybox="gallery" href="{{ asset('storage/fotoProfileAdmin/' . $u->foto) }}">
          <img src="{{ asset('storage/fotoProfileAdmin/' . $u->foto) }}" style="height: 70px; width: 70px;" class="rounded-circle" alt="">
        </a>
      </td>
                                        <td class="text-center">
                                        <form id="delete-form-{{ $u->id }}" action="{{ route('users.destroy', $u->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" id="delete-btn-{{ $u->id }}" style="display: none;">Hapus</button>
</form>

<a href="#" class="btn btn-danger delete-user" data-id="{{ $u->id }}" data-username="{{ $u->username }}">
    <i class="fa-solid fa-trash"></i> Hapus
</a>

                                            <a href="/Users/edit/{{$u->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Ubah</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#table').DataTable();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.delete-user').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();

            var userId = this.getAttribute('data-id');
            var username = this.getAttribute('data-username');

            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus user dengan username ' + username + '?',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
<script>
    document.addEventListener('DOMContentLoaded', function() {

        Fancybox.bind("[data-fancybox]", {

        });
    });
</script>
@endsection
