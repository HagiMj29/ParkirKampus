<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your head content here -->
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table, .table th, .table td {
            border: 1px solid #000; /* Border color and thickness */
        }

        /* Add CSS styles for center-aligning table text */
        .table td, .table th {
            text-align: center;
        }

        .title{
            text-align: center
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title text-center">Rekap Data History Parkir Kendaraan Bermotor</h1>
                <h4 class="title text-center">Kampus Politenik Negeri Padang</h4>
                <div class="card border-0 shadow rounded">
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Nama</th>
                                    <th scope="col" class="text-center">Slot</th>
                                    <th scope="col" class="text-center">Plat Nomor Kendaraan</th>
                                    <th scope="col" class="text-center">Plat Nomor Kendaraan<br/>(jika menggunakan kendaraan lain)</th>
                                    <th scope="col" class="text-center">Waktu Masuk</th>
                                    <th scope="col" class="text-center">Waktu Keluar</th>
                                    <th scope="col" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($varparkingActivity as $data)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td class="text-center">{!! $data->user->name !!}</td>
                                        <td class="text-center">{{ $data->slot->slot }}</td>
                                        <td class="text-center">{!! $data->vehicle == null ?'-':$data->vehicle->vehicle_number !!}</td>
                                        <td class="text-center">{!! $data->vehicle_etc !!}</td>
                                        <td class="text-center">{!! $data->in_datetime !!}</td>
                                        <td class="text-center">{!! $data->out_datetime !!}</td>
                                        <td class="text-center">{{ $data->status }}</td>
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
</body>
</html>
