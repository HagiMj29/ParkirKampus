@extends('layouts.main2')
@section('container')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('parkingcomplaints.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                        
                        <form action="{{ route('parkingcomplaints.index') }}" method="GET" class="mb-3">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 d-flex">
                                    <input type="text" name="search" class="form-control" placeholder="Cari data.." value="{{request('search')}}">
                                    <button type="submit" class="btn btn-info mx-3">Cari</button>
                                </div>
                            </div>
                        </form>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Nama</th>
                                    <th scope="col" class="text-center">Slot</th>
                                    <th scope="col" class="text-center">Deskripsi</th>
                                    <th scope="col" class="text-center">Balasan</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($listcomplaints as $data)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td class="text-center">{!! $data->user->name !!}</td>
                                        <td class="text-center">{{ $data->slot->slot }}</td>
                                        <td class="text-center">{!! $data->description !!}</td>
                                        <td class="text-center">{{ $data->reply }}</td>
                                        <td class="text-center">{{ $data->status }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('parkingcomplaints.destroy', ['parkingcomplaint' => $data->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('parkingcomplaints.edit', ['parkingcomplaint' => $data->id]) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Pengaduan belum Tersedia.
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
