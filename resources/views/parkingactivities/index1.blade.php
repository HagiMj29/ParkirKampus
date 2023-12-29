@extends('layouts.main2')
@section('container')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('parkingactivities.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>

                        <form action="{{ route('parkingactivities.index') }}" method="GET" class="mb-3">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 d-flex">
                                    <input type="text" name="search" class="form-control" placeholder="Cari data.." value="{{request('search')}}">
                                    <button type="submit" class="btn btn-info mx-3">Cari</button>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('parkingactivities.index') }}" method="GET" class="mb-3">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 d-flex">
                                    <button type="submit" class="btn btn-info mx-3">Parkir Hari Ini</button>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('parkingactivities.cetak_pdf') }}" method="GET" class="mb-3">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8"></div> 
                                <div class="col-lg-4 d-flex justify-content-end"> 
                                    <button type="submit" class="btn btn-success mx-3">Cetak</button>
                                </div>
                            </div>
                        </form>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Nama</th>
                                    <th scope="col" class="text-center">Slot</th>
                                    <th scope="col" class="text-center">Plat Nomor Kendaraan</th>
                                    <th scope="col" class="text-center">Brand Kendaraan</th>
                                    <th scope="col" class="text-center">Waktu Masuk</th>
                                    <th scope="col" class="text-center">Waktu Keluar</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($varparkingActivity1 as $data)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td class="text-center">{!! $data->user->name !!}</td>
                                        <td class="text-center">{{ $data->slot->slot }}</td>
                                        <td class="text-center">{!! $data->vehicle_number !!}</td>
                                        <td class="text-center">{!! $data->vehicle_brand !!}</td>
                                        <td class="text-center">{!! $data->in_datetime !!}</td>
                                        <td class="text-center">{!! $data->out_datetime !!}</td>
                                        <td class="text-center">{{ $data->status }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('parkingactivities.destroy', ['parkingactivity' => $data->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('parkingactivities.edit', ['parkingactivity' => $data->id]) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Aktivitas Parkir belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- {{ $listuser->links() }} --}}
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
