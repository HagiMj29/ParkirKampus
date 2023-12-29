@extends('layouts.main2')
@section('container')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="create" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                        <form action="{{ route('vehicles.index') }}" method="GET" class="mb-3">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 d-flex">
                                <input type="text" name="search" class="form-control" placeholder="Cari plat atau brand kendaraan" value="{{request('search')}}">
                                <button type="submit" class="btn btn-info mx-3">Cari</button>
                            </div>
                        </div>
                        </form>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Pengguna</th>
                                    <th scope="col" class="text-center">Nomor Plat Kendaraan</th>
                                    <th scope="col" class="text-center">Brand Kendaraan</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($listvehicle as $data)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td class="text-center">{!! $data->user->name !!}</td>
                                        <td class="text-center">{!! $data->vehicle_number !!}</td>
                                        <td class="text-center">{{ $data->vehicle_brand }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="#"
                                                method="POST">
                                                <a href="#"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Kendaraan belum Didaftarkan Oleh Pengguna.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
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
