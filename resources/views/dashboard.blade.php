@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Welcome, {{ Auth::user()->name }}</h3>
                <h6 class="font-weight-normal mb-0">You have a complete dashboard overview here!</h6>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 grid-margin transparent">
        <div class="card card-tale">
            <div class="card-body">
                <p class="mb-4">Total Buku Bacaan</p>
                <p class="fs-30 mb-2">4006</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin transparent">
        <div class="card card-tale">
            <div class="card-body">
                <p class="mb-4">Total Pertanyaan</p>
                <p class="fs-30 mb-2">3201</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin transparent">
        <div class="card card-tale">
            <div class="card-body">
                <p class="mb-4">Total Pertanyaan Terjawab</p>
                <p class="fs-30 mb-2">3000</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin transparent">
        <div class="card card-tale">
            <div class="card-body">
                <p class="mb-4">Total Pertanyaan Tidak Terjawab</p>
                <p class="fs-30 mb-2">201</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Chart 1 -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Jumlah Teks Bacaan per Tahun</h4>
                <canvas id="chartReadingText"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart 2 -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Jumlah Siswa vs Jumlah Teks Bacaan</h4>
                <canvas id="chartStudents"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Data untuk chart pertama
    const ctx1 = document.getElementById('chartReadingText').getContext('2d');
    const chartReadingText = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['2018', '2019', '2020', '2021', '2022'], // Tahun
            datasets: [{
                label: 'Jumlah Teks Bacaan',
                data: [20, 30, 50, 40, 70], // Data jumlah teks bacaan
                backgroundColor: '#1CB2A2',
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Jumlah Teks Bacaan per Tahun',
                },
            },
        },
    });

    // Data untuk chart kedua
    const ctx2 = document.getElementById('chartStudents').getContext('2d');
    const chartStudents = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['10', '20', '30', '40', '50'], // Jumlah teks bacaan
            datasets: [{
                label: 'Jumlah Siswa',
                data: [50, 100, 150, 200, 250], // Data jumlah siswa
                backgroundColor: '#8B9DAB',
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Jumlah Siswa vs Jumlah Teks Bacaan',
                },
            },
        },
    });
</script>
@endpush
