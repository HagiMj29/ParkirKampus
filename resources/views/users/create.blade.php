@extends('layouts.main2')
@section('container')

<div class="container mt-5 col-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="/users/store" method="POST" enctype="multipart/form-data" >
                        @csrf
                        @method('post')
                        <div class="form-control mb-12">
                            <input type="text" name="name" placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="form-control mb-12">
                        <input type="email" name="email" placeholder="Masukkan Email">
                        </div>
                        <div class="form-control mb-12">
                        <input type="password" name="password" placeholder="Masukkan Password">
                        </div>
                        <div class="form-control mb-12">
                        <input type="text" name="phone" placeholder="Masukkan Nomor Telepon">
                        </div>
                        <div class="form-control mb-12">
                            <select class="form-select" name="role" aria-label="Default select example">
                                <option selected value="Admin">Admin</option>
                                <option value="Pengunjung">Pengunjung</option>
                              </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">GAMBAR</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
                        
                            <!-- error message untuk title -->
                            @error('photo')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //message with toastr
    @if(session()->has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script>

@endsection