@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Kolom 1: Judul dan Isi -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ $teksBacaan->judul }}</h4>
                </div>
                <div class="card-body">
                    <p class="text-justify">{{ $teksBacaan->isi }}</p>
                </div>
            </div>
        </div>

        <!-- Kolom 2: Pertanyaan dan Jawaban -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Pertanyaan</h5>
                </div>
                <div class="card-body">
                    <!-- Form untuk Semua Pertanyaan dan Jawaban -->
                    <form action="{{ route('jawaban.store') }}" method="POST">
                        @csrf
                        @forelse ($pertanyaan as $qa)
                        <div class="mb-4">
                            <h6 class="fw-bold">{{ $loop->iteration }}. {{ $qa->pertanyaan }}</h6>
                            @php
                                // Cek apakah user sudah menjawab pertanyaan ini
                                $jawabanSiswa = $jawaban->firstWhere('qa_id', $qa->qa_id);
                            @endphp

                            <!-- Input Jawaban untuk Pertanyaan -->
                            @if ($jawabanSiswa)
                                <textarea class="form-control mb-2" rows="2" readonly>{{ $jawabanSiswa->isi }}</textarea>
                                <!-- Input Nilai -->
                                @if (isset($jawabanSiswa->nilai))
                                    <input type="number" class="form-control mb-2" value="{{ $jawabanSiswa->nilai }}" readonly>
                                @else
                                    <input type="number" name="nilai[{{ $qa->qa_id }}]" class="form-control mb-2" placeholder="Masukkan nilai" min="0" max="100" required>
                                @endif
                            @else
                                <input type="hidden" name="qa_ids[]" value="{{ $qa->qa_id }}">
                                <textarea name="jawaban_siswa[]" class="form-control mb-2" rows="2" placeholder="Tulis jawaban Anda..." required></textarea>
                            @endif
                        </div>
                        @empty
                        <p class="text-muted">Tidak ada pertanyaan untuk teks bacaan ini.</p>
                        @endforelse

                        <!-- Button Kirim Jawaban -->
                        @if ($pertanyaan->isNotEmpty() && $jawaban->whereNull('nilai')->isNotEmpty())
                        <button type="submit" class="btn btn-primary w-100">Kirim Semua Jawaban</button>
                        @endif
                    </form>
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
        font-size: 16px;
        line-height: 1.6;
    }
    .form-control {
        font-size: 14px;
    }
</style>
@endsection
