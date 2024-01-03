@extends('layouts.main2')

@section('container')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body text-center">
                    <h1>Detail Pengguna</h1>
                    <!-- Tampilkan informasi pengguna di sini -->
                    <ul style="list-style-type: none; padding-left: 0;">
                        <li><img src="{{ Storage::url('image/' . $user->photo) }}" alt="User Photo" class="rounded mx-auto d-block" style="width: 150px;"></li>
                        <li class="text-lg"><strong>Nama:</strong> {{ $user->name }}</li>
                        <li class="text-lg"><strong>Email:</strong> {{ $user->email }}</li>
                        <li class="text-lg"><strong>Telepon:</strong> {{ $user->phone }}</li>
                        <li class="text-lg"><strong>Role:</strong> {{ $user->role }}</li>
                    </ul>
                    <a href="https://wa.me/{{ $user->phone }}?text=Halo,%20Keluhan%20Anda%20Sudah%20Kami%20Terima." class="btn btn-info" target="_blank">Hubungi</a>
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    //message with toastr
    @if (session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif (session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif
</script>
@endsection
