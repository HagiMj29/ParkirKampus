@extends('layouts.main2')
@section('container')
    <div class="container mt-5 col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('parkingslots.store') }}" method="POST">
                            @csrf
                            @method('post')
                            <div class="form-control mb-12">
                                <input type="text" name="slot" placeholder="Masukkan Slots">
                            </div>
                            <div class="form-control mb-12">
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option value="Kosong{{ $listslot->status == 'Kosong' ? 'selected' : '' }}">Kosong
                                    </option>
                                    <option value="Berisi{{ $listslot->status == 'Berisi' ? 'selected' : '' }}">Berisi
                                    </option>
                                </select>
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
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endsection
