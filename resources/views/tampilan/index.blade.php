@extends('layout.app')
@section('content')

<div class="container">
    <div class="justify-content-center d-flex">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Tampilan Footer</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                @if(session('berhasil'))
<script>
        function success() {
            Swal.fire({
                icon: 'success',
                title: '{{ session("berhasil")}}',
            });
        }
        
        success();
    </script>
@endif

                  

                    

                    @if(session('gagal'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: '{{ session('
                            gagal ') }}'
                        });
                    </script>
                    @endif
                    <div class="container">
                        <div class="mt-auto bg-body-tertiary">
                            <div class="container p-4">
                                <div class="row">
                                        <h1 style="cursor: pointer;" id="header_footer">header</h1>
                                    </div>
                                   
                                        <div class="row">
                                            <div class="col-md-4 mt-3">
                                                <a class="text-decoration-none text-dark" href="text1R" target="_BLANK" id="text1_footer">text1</a>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <a class="text-decoration-none text-dark" href="text2R" target="_BLANK" id="text2_footer">text2</a>
                                            </div>
                                            <div class="col-md-4 mt-3">
                                                <a class="text-decoration-none text-dark"  href="text3R" target="_BLANK" id="text3_footer">text3</a>
                                            </div>
                                        </div>
                                  
                                    </div>
                                </div>
                                <footer class='bg-dark text-center text-light d-flex justify-content-center mb-3'>
                                    <br>
                                    <p>&copy;</p><p id="copy_footer"> copy</p>
                                </footer>
                    </div>


<form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('header')) is-invalid @endif" name="header" id="header" placeholder="" value="<?php if(old('header')){ echo old('header'); }else{ echo $footer->header; } ?>">
                            <label for="header">Header footer</label>
                            @if($errors->has('header')) 
                            <div class="invalid-feedback">
                                {{$errors->first('header')}}
                            </div>
                            @endif
                        </div>
                        
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control @if($errors->has('text1')) is-invalid @endif" name="text1" id="text1" placeholder="" value="<?php if(old('text1')){ echo old('text1'); }else{ echo $footer->text1; } ?>">
                            <label for="text1">Text 1</label>
                            @if($errors->has('text1')) 
                            <div class="invalid-feedback">
                                {{$errors->first('text1')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('text1R')) is-invalid @endif" name="text1R" id="text1R" placeholder="" value="<?php if(old('text1R')){ echo old('text1R'); }else{ echo $footer->text1R; } ?>">
                            <label for="text1R">Text 1 arahan</label>
                            @if($errors->has('text1R')) 
                            <div class="invalid-feedback">
                                {{$errors->first('text1R')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control @if($errors->has('text2')) is-invalid @endif" name="text2" id="text2" placeholder="" value="<?php if(old('text2')){ echo old('text2'); }else{ echo $footer->text2; } ?>">
                            <label for="text2">Text 2</label>
                            @if($errors->has('text2')) 
                            <div class="invalid-feedback">
                                {{$errors->first('text2')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('text2R')) is-invalid @endif" name="text2R" id="text2R" placeholder="" value="<?php if(old('text2R')){ echo old('text2R'); }else{ echo $footer->text2R; } ?>">
                            <label for="text2R">Text 2 arahan</label>
                            @if($errors->has('text2R')) 
                            <div class="invalid-feedback">
                                {{$errors->first('text2R')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control @if($errors->has('text3')) is-invalid @endif" name="text3" id="text3" placeholder="" value="<?php if(old('text3')){ echo old('text3'); }else{ echo $footer->text3; } ?>">
                            <label for="text3">Text 3</label>
                            @if($errors->has('text3')) 
                            <div class="invalid-feedback">
                                {{$errors->first('text3')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('text3R')) is-invalid @endif" name="text3R" id="text3R" placeholder="" value="<?php if(old('text3R')){ echo old('text3R'); }else{ echo $footer->text3R; } ?>">
                            <label for="text3R">Text 3 arahan</label>
                            @if($errors->has('text3R')) 
                            <div class="invalid-feedback">
                                {{$errors->first('text3R')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('copy')) is-invalid @endif" name="copy" id="copy" placeholder="" value="<?php if(old('copy')){ echo old('copy'); }else{ echo $footer->copyRight; } ?>">
                            <label for="copy">Copy right</label>
                            @if($errors->has('copy')) 
                            <div class="invalid-feedback">
                                {{$errors->first('copy')}}
                            </div>
                            @endif
                        </div>
                       
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Ubah Footer</button>
                          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        Fancybox.bind("[data-fancybox]", {
           
        });

        function updateFooterExample() {
            // Get input values
            var inputHeader = document.getElementById('header').value;
            var inputText1 = document.getElementById('text1').value;
            var inputText1R = document.getElementById('text1R').value;
            var inputText2 = document.getElementById('text2').value;
            var inputText2R = document.getElementById('text2R').value;
            var inputText3 = document.getElementById('text3').value;
            var inputText3R = document.getElementById('text3R').value;
            var inputCopy = document.getElementById('copy').value;

            // Update footer example
            document.getElementById('header_footer').innerText = inputHeader;
            document.getElementById('text1_footer').innerText = inputText1;
            document.getElementById('text1_footer').href = inputText1R;
            document.getElementById('text2_footer').innerText = inputText2;
            document.getElementById('text2_footer').href = inputText2R;
            document.getElementById('text3_footer').innerText = inputText3;
            document.getElementById('text3_footer').href = inputText3R;
            document.getElementById('copy_footer').innerText =  inputCopy;
        }

        // Initial update on page load
        updateFooterExample();

        // Add event listeners for inputs
        document.getElementById('header').addEventListener('input', updateFooterExample);
        document.getElementById('text1').addEventListener('input', updateFooterExample);
        document.getElementById('text1R').addEventListener('input', updateFooterExample);
        document.getElementById('text2').addEventListener('input', updateFooterExample);
        document.getElementById('text2R').addEventListener('input', updateFooterExample);
        document.getElementById('text3').addEventListener('input', updateFooterExample);
        document.getElementById('text3R').addEventListener('input', updateFooterExample);
        document.getElementById('copy').addEventListener('input', updateFooterExample);
    
    });
</script>
<script>
//   var inputHeader = document.getElementById('header');
//   var header = document.getElementById('header_footer');

//   header.innerText = inputHeader.value;
//   inputHeader.addEventListener('input', function(){
// header.innerText = inputHeader.value;
//   })
</script>

@endsection