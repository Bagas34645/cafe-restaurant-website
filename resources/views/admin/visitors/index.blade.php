@extends('layouts.admin')

@section('title', 'Statistik Pengunjung')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Statistik Pengunjung Website</h1>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Total Pengunjung</h6>
                    <h2>{{ $total }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Hari Ini</h6>
                    <h2>{{ $today }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Minggu Ini</h6>
                    <h2>{{ $week }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6>Bulan Ini</h6>
                    <h2>{{ $month }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Daftar Kunjungan Terbaru</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitors as $visitor)
                        <tr>
                            <td>{{ $visitor->created_at }}</td>
                            <td>{{ $visitor->ip_address }}</td>
                            <td>{{ Str::limit($visitor->user_agent, 40) }}</td>
                            <td>{{ $visitor->url }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $visitors->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
