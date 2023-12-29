@extends('layouts.main2')
@section('container')
    <div class="container mt-5 col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('parkingcomplaints.store') }}" method="POST">
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
                                <label for="slot">Slot Parkir</label>
                                <select class="form-select" name="slot_id">
                                    @foreach ($slots as $slot)
                                        <option value="{{ $slot->id }}"
                                            {{ old('slot_id') == $slot->id ? 'selected' : '' }}>{{ $slot->slot }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-control mb-12">
                                <label>Deskripsi Keluhan</label>
                                <textarea class="form-control" type="text" name="description" placeholder="Masukkan deskripsi keluhan"></textarea>
                            </div>
                            <div class="form-control mb-12">
                                <label>Balasan Admin</label>
                                <select class="form-select" name="reply" aria-label="Default select example">
                                    <option value="Silakan menuju ke Posko 1">Silakan menuju ke Posko 1</option>
                                    <option value="Silakan buka pesan di Whatsapp">Silakan buka pesan di Whatsapp</option>
                                </select>
                            </div>
                            <div class="form-control mb-12">
                                <label>Status</label>
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option value="Diproses" {{ old('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai
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
