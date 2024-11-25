@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #1D3341">Pembelajaran</h2>

    <div class="row">
        @foreach ($teksBacaan as $teks)
        <div class="col-md-3 mb-4">
            <div class="card gradient-card shadow-sm animate-card">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-dark fw-bold">{{ $teks->judul }}</h5>
                    <p class="card-text text-muted">
                        {{ Str::limit($teks->isi, 100) }}
                    </p>
                    <div class="mt-auto text-end">
                        <a href="{{ route('teks-bacaan.show', $teks->text_id) }}" class="btn custom-btn shadow-sm">
                            Tampilkan 😊
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<style>
    /* Gradiasi untuk Card */
    .gradient-card {
        background: linear-gradient(135deg, #1cb2a2, #3acfd5);
        color: white;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .gradient-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Animasi untuk Card */
    .animate-card {
        animation: fadeInUp 0.5s ease-in-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Tombol Menarik */
    .btn.custom-btn {
        background-color: #ffffff;
        color: #1cb2a2;
        font-weight: 600;
        border: 2px solid #1cb2a2;
        transition: all 0.3s ease-in-out;
        border-radius: 20px;
    }

    .btn.custom-btn:hover {
        background-color: #1cb2a2;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0px 6px 12px rgba(28, 178, 162, 0.4);
    }
</style>
@endsection
