@extends('layouts.app')

@section('content')
<style>
    .custom-title {
        color: #1D3341;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
    }
</style>

<div class="container mt-1">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="custom-title">Teks Bacaan</h2>
        <!-- Tombol Tambah -->
        <a href="{{ route('teks-bacaan.create') }}" class="btn custom-btn shadow-sm">
            <i class="mdi mdi-plus-circle"></i> Tambah Teks Bacaan
        </a>
    </div>    

    <!-- Card berisi Tabel -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="teksBacaanTable">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Isi</th>
                                    <th>Jumlah Pembaca</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teksBacaan as $index => $teks)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $teks->judul }}</td>
                                    <td>{{ $teks->created_at->format('d-m-Y') }}</td>
                                    <td>{{ Str::limit($teks->isi, 100) }}</td>
                                    <td>{{ $teks->jumlah_pembaca > 0 ? $teks->jumlah_pembaca : '-' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn custom-btn shadow-sm dropdown-toggle animate-hover" type="button" id="dropdownMenuButton{{ $teks->text_id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $teks->text_id }}">
                                                <li><a class="dropdown-item" href="{{ route('teks-bacaan.detail', $teks->text_id) }}">Detail</a></li>
                                                <li><a class="dropdown-item" href="{{ route('teks-bacaan.edit', $teks->text_id) }}">Edit</a></li>
                                                <li>
                                                    <form action="{{ route('teks-bacaan.destroy', $teks->text_id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus teks ini?')">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<!-- Custom CSS -->
<style>
    .btn.custom-btn {
        background-color: #1CB2A2;
        color: white;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        border: none;
        transition: all 0.3s ease-in-out;
    }
    .btn.custom-btn:hover {
        background-color: #17a085;
        box-shadow: 0px 4px 12px rgba(28, 178, 162, 0.5);
        transform: translateY(-3px);
    }
    .btn.animate-hover {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn.animate-hover:hover {
        transform: scale(1.05);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    .card {
        border: none;
        border-radius: 8px;
    }
    .card-header {
        border-bottom: 2px solid #e9ecef;
    }
</style>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#teksBacaanTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/Indonesian.json"
            }
        });
    });
</script>
@endsection
