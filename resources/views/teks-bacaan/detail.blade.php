@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Kolom 1: Judul dan Isi -->
        <div class="col-md-7">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ $teksBacaan->judul }}</h4>
                </div>
                <div class="card-body">
                    <p class="text-justify">{{ $teksBacaan->isi }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Daftar User</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>User ID</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jawabanUsers as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $user->user_id }}</td>
                                    <td>
                                        <a href="{{ route('nilai.show', [$teksBacaan->text_id, $user->user_id]) }}" class="btn btn-primary btn-sm">Nilai</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada jawaban</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<style>
    .card {
        border: none;
        border-radius: 8px;
    }
    .card-header {
        font-weight: bold;
    }
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card.h-100 {
        min-height: 300px; /* Tinggi minimum yang sama untuk kedua card */
    }
</style>
@endsection
