@extends('layouts.main2')
@section('container')
    <div class="container mt-5 col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('parkingslots.update', ['parkingslot' => $parkingslot->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-control mb-12">
                                <input type="text" name="slot" value="{{ old('slot', $parkingslot->slot) }}"
                                    placeholder="Masukkan Slots">
                            </div>
                            <div class="form-control mb-12">
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option value="Kosong" {{ $parkingslot->status == 'Kosong' ? 'selected' : '' }}>Kosong
                                    </option>
                                    <option value="Berisi" {{ $parkingslot->status == 'Berisi' ? 'selected' : '' }}>Berisi
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
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
