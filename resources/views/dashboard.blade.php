@extends('layouts.main2')
@section('container')
    <div class="container mt-5">
        <div>
            <h4>Selamat Datang, {{ Auth::user()->name }}</h4>
        </div>
        <div class="card-group">
            <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalVisitorUsers }}</h5>
                </div>
            </div>
            <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Total Parkir Masuk</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalVisitorActivities }}</h5>
                </div>
            </div>

            <div class="card text-bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header">Total Pengaduan Sedang di proses</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalVisitorComplaints2 }}</h5>
                </div>
            </div>
            <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">Total slot parkir Berisi</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalParkingSlot }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <table class="table table-bordered">
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($totalVisitorComplaints as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{!! $data->user->name !!}</td>
                                    <td>{{ $data->slot->slot }}</td>
                                    <td>{!! $data->description !!}</td>

                                </tr>
                            @empty
                            <div class="alert alert-danger">
                                {{ Auth::user()->name }}, Saat ini, Belum ada pengunjung yang mengadukan keluhannya.
                            </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    </div>
@endsection
