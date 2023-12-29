@extends('layouts.main2')
@section('container')
    <div class="container mt-5 col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('vehicles.store') }}" method="POST">
                            @csrf
                            @method('post')
                            <div class="form-group mb-3">
                            <label for="vehicle_number">Brand Kendaraan</label>
                            <select class="form-select" name="user_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            </div>   
                            <div class="form-group mb-3">
                                <label for="vehicle_number">Nomor Plat Kendaraan</label>
                                <input type="text" id="vehicle_number" name="vehicle_number" class="form-control" placeholder="Nomor Plat Kendaraan">
                            </div>
                            <div class="form-group mb-3">
                                <label for="vehicle_number">Brand Kendaraan</label>
                                <select class="form-select" id="vehicle_brand" name="vehicle_brand" aria-label="Pilih Brand Kendaraan">
                                    <option value="Honda" {{ old('vehicle_brand') == 'Honda' ? 'selected' : '' }}>Honda</option>
                                    <option value="Suzuki" {{ old('vehicle_brand') == 'Suzuki' ? 'selected' : '' }}>Suzuki</option>
                                    <option value="Yamaha" {{ old('vehicle_brand') == 'Yamaha' ? 'selected' : '' }}>Yamaha</option>
                                    <option value="Lainnya" {{ old('vehicle_brand') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Tampilkan pesan dengan Toastr
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endsection
