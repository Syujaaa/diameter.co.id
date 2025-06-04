@extends('layout.app')
@section('content')
@php
use Carbon\Carbon;
@endphp
<style>
    a.text-decoration-none {
             position: relative;
             text-decoration: none;
         }
         
         a.text-decoration-none::after {
             content: '';
             position: absolute;
             width: 0;
             height: 1px;
             display: block;
             margin-top: 2px;
             left: 0;
             background: #0033ff;
             transition: width 0.3s ease, left 0.3s ease;
         }
 
         a.text-decoration-none:hover::after {
             width: 100%;
             left: 0;
         }
 </style>
<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Daftar Activity Admin</h1>
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
                   
                    <div class="table-responsive">
                    <table class="table-striped table-bordered table align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">IP</th>
                                <th class="text-center">Aktivitas terakhir</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            @foreach($activity as $a)
                                <tr>
                                    <td class="text-center">{{$no++}}</td>
                                    <td class="text-center"><?= $a->username ?></td>
                                    <td class="text-center">{{ $a->ip_address }}</td>
                                    <td class="text-center">  <?php 
                                        
                                        $timestamp = $a->last_activity;
                                        $date = Carbon::createFromTimestamp($timestamp)->locale('id')->timezone('Asia/Jakarta');
                                        echo $date->translatedFormat('l, j F Y H:i:s');
                                    ?></td>
                                   <td class="text-center"> <form id="delete-form-{{ $a->id }}" action="{{ route('activity.destroy', $a->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" id="delete-btn-{{ $a->id }}" style="display: none;">Hapus</button>
</form>

<a href="#" class="btn btn-danger delete-user" data-id="{{ $a->id }}" data-nama="{{ $a->ip_address }}">
    <i class="fa-solid fa-trash"></i> Hapus
</a> </td>
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
        $('#table').DataTable({
            
        });
    });
</script>
<script>
    document.querySelectorAll('.delete-user').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); 

            var userId = this.getAttribute('data-id');
            var nama = this.getAttribute('data-nama');

            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus Activity dengan IP ' + nama + '?',
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

@endsection