@extends('layout.app')
@section('content')


    <div class="col-md-7">
        <div class="card mt-5">
            <div class="card-header text-center">
                <h1>Daftar Admin</h1>
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
                    <a href="/Admin/Tambah" class="btn btn-primary">Tambah</a>
                </div>
                <div class="table-responsive">
                    <table class="table-striped table table-bordered align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th> 
                                <th class="text-center">Username</th> 
                               
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php
                        $no = 1;
                        ?>
                        <tbody>
                            @foreach($admin as $a)
                                <tr>
                                    <td class="text-center">{{$no++}}</td>
                                    <td class="text-center">{{$a->nama}}</td>
                                    <td class="text-center">{{$a->username}}</td>
                                    <td class="text-center">
                                    <form id="delete-form-{{ $a->id }}" action="" method="POST" style="display: none;">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger" id="delete-btn-{{ $a->id }}" style="display: none;">Hapus</button>
</form>

<a href="#" class="btn btn-danger delete-user" data-id="{{ $a->id }}" data-username="{{ $a->username }}">
Hapus
</a>

                                        <a href="/Admin/Users/edit/{{$a->id}}" class="btn btn-warning">Ubah</a>
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
@endsection