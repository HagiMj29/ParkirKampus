@extends('layouts.main2')
@section('container')
    <div class="container mt-5 col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('parkingcomplaints.update', ['parkingcomplaint' => $parkingcomplaint->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-control mb-12">
                                <label for="user">Pengguna</label>
                                <select class="form-select" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id',$parkingcomplaint->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-control mb-12">
                                <label for="slot">Slot</label>
                                <select class="form-select" name="slot_id">
                                    @foreach ($slots as $slot)
                                        <option value="{{ $slot->id }}"
                                            {{ old('slot_id',$parkingcomplaint->slot_id) == $slot->id ? 'selected' : '' }}>{{ $slot->slot }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-control mb-12">
                                <input type="text" name="description" value="{{old('description', $parkingcomplaint->description)}}" placeholder="Masukkan deskripsi keluhan">
                            </div>
                            <div class="form-control mb-12">
                                <select class="form-select" name="reply" aria-label="Default select example">
                                    <option value="Silakan menuju ke Posko 1"{{old('reply',$parkingcomplaint->reply) == 'Silakan menuju ke Posko 1' ? 'selected' : ' '}}>Silakan menuju ke Posko 1</option>
                                    <option value="Silakan buka pesan di Whatsapp"{{old('reply',$parkingcomplaint->reply) == 'Silakan buka pesan di Whatsapp' ? 'selected' : ' '}}>Silakan buka pesan di Whatsapp</option>
                                </select>
                            </div>
                            <div class="form-control mb-12">
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option value="Diproses" {{ old('status',$parkingcomplaint->status) == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Selesai" {{ old('status',$parkingcomplaint->status) == 'Selesai' ? 'selected' : '' }}>Selesai
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
