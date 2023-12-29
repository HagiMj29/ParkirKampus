@extends('layouts.main2')
@section('container')
    <div class="container mt-5 col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('parkingactivities.update', ['parkingactivity' => $parkingactivity->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-control mb-12">
                                <label for="user">Pengguna</label>
                                <select class="form-select" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id',$parkingactivity->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-control mb-12">
                                <label for="slot">Slot</label>
                                <select class="form-select" name="slot_id">
                                    @foreach ($slots as $slot)
                                        <option value="{{ $slot->id }}"
                                             {{ old('slot_id',$parkingactivity->slot_id) == $slot->id ? 'selected' : '' }}>{{ $slot->slot }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-control mb-12">
                                <label for="slot">Masukkan Nomor Kendaraan</label>
                                <input type="text" value="{{ old('vehicle_number', $parkingactivity->vehicle_number)}}" class="form-control" name="vehicle_number" placeholder="Masukkan Nomor Kendaraan">
                            </div>

                            <div class="form-control mb-12">
                                <label for="slot">Masukkan Nomor Kendaraan</label>
                                <select class="form-select"  aria-label="Default select example" name="vehicle_brand">
                                <option value="Honda" {{ $parkingactivity->vehicle_brand === 'Honda' ? 'selected' : '' }}>Honda</option>
                                <option value="Suzuki" {{ $parkingactivity->vehicle_brand === 'Suzuki' ? 'selected' : '' }}>Suzuki</option>
                                </select>
                            </div>
                            <div class="form-control mb-12">
                                <label for="slot">Waktu Masuk</label>
                                <input type="datetime-local" class="form-control" name="in_datetime" value="{{ old('in_datetime',$parkingactivity->in_datetime) }}"
                                    placeholder="Masukkan waktu masuk">
                            </div>
                            <div class="form-control mb-12">
                                <label for="slot">Waktu Keluar</label>
                                <input type="datetime-local" class="form-control" name="out_datetime" value="{{ old('out_datetime',$parkingactivity->out_datetime) }}"
                                    placeholder="Masukkan waktu keluar">
                            </div>
                            <div class="form-control mb-12">
                                <label for="slot">Status</label>
                                <select class="form-select" class="form-control" name="status" aria-label="Default select example">
                                    <option value="Masuk" {{ old('status',$parkingactivity->status) == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                                    <option value="Keluar" {{ old('status',$parkingactivity->status) == 'Keluar' ? 'selected' : '' }}>Keluar
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
