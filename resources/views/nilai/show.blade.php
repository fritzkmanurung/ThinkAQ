@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Kolom 1: Teks Bacaan -->
        <div class="col-md-7">
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
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Penilaian Jawaban</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('nilai.store', [$teksBacaan->text_id, $user_id]) }}" method="POST">
                        @csrf
                        @foreach ($pertanyaan as $qa)
                        @php
                            $jawaban = $jawabanSiswa->firstWhere('qa_id', $qa->qa_id);
                        @endphp
                        <div class="mb-4">
                            <h6 class="fw-bold">{{ $loop->iteration }}. {{ $qa->pertanyaan }}</h6>
                            <textarea class="form-control mb-2" rows="2" readonly>{{ $jawaban->isi ?? 'Belum ada jawaban' }}</textarea>
                            
                            <!-- Input Nilai -->
                            @if (isset($jawaban->nilai))
                                <!-- Jika sudah ada nilai, input diblok -->
                                <input type="number" class="form-control" value="{{ $jawaban->nilai }}" readonly>
                            @else
                                <!-- Jika belum ada nilai, input dapat diisi -->
                                <input type="number" name="nilai[{{ $qa->qa_id }}]" class="form-control" placeholder="Masukkan nilai" min="0" max="100" required>
                            @endif
                        </div>
                        @endforeach
                        
                        <!-- Tampilkan tombol hanya jika ada pertanyaan yang belum dinilai -->
                        @if ($jawabanSiswa->whereNull('nilai')->isNotEmpty())
                        <button type="submit" class="btn btn-primary w-100">Simpan Nilai</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
