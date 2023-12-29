@extends('layouts.main2')
@section('container')
    <div class="container mt-5 col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('parkingactivities.store') }}" method="POST">
                            @csrf
                            @method('post')
                            <div class="form-control mb-12">
                                <label for="user">Pengguna</label>
                                <select class="form-select" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-control mb-12">
                                <label for="slot">Slot</label>
                                <select class="form-select" name="slot_id">
                                    @foreach ($slots as $slot)
                                        <option value="{{ $slot->id }}"
                                            {{ old('slot_id') == $slot->id ? 'selected' : '' }}>{{ $slot->slot }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-control mb-12">
                                <label for="slot">Masukkan Nomor Kendaraan</label>
                                <input type="text" class="form-control" name="vehicle_number" placeholder="Masukkan Nomor Kendaraan">
                            </div>
            
                            <div class="form-control mb-12">
                                <label for="slot">Masukkan Brand Kendaraan</label>
                                <select class="form-select" name="vehicle_brand" aria-label="Default select example">
                                    <option value="Honda" {{ old('vehicle_brand') == 'Honda' ? 'selected' : '' }}>Honda
                                    </option>
                                    <option value="Suzuki" {{ old('vehicle_brand') == 'Suzuki' ? 'selected' : '' }}>Suzuki
                                    </option>
                                    <option value="Yamaha" {{ old('vehicle_brand') == 'Yamaha' ? 'selected' : '' }}>Yamaha
                                    </option>
                                    <option value="Lainnya" {{ old('vehicle_brand') == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                            </div>
                            <div class="form-control mb-12">
                                <input type="datetime-local" class="form-control" name="in_datetime" value="{{ old('in_datetime') }}"
                                    placeholder="Masukkan waktu masuk">
                            </div>
                            <div class="form-control mb-12">
                                <input type="datetime-local" class="form-control" name="out_datetime" value="{{ old('out_datetime') }}"
                                    placeholder="Masukkan waktu keluar">
                            </div>
                            <div class="form-control mb-12">
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option value="Masuk" {{ old('status') == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                                    <option value="Keluar" {{ old('status') == 'Keluar' ? 'selected' : '' }}>Keluar
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
