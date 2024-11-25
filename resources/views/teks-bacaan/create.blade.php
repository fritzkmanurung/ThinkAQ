@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Card 1: Tambah Teks Bacaan -->
        <div class="col-md-6">
            <div class="card shadow-sm" id="teksBacaanCard">
                <div class="card-header text-white" style="background: #1CB2A2">
                    <h4 class="mb-0">Tambah Teks Bacaan</h4>
                </div>
                <div class="card-body" id="teksBacaanForm">
                    <form id="formTeksBacaan" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul teks bacaan" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="isi" class="form-label">Isi</label>
                            <textarea class="form-control" id="isi" name="isi" rows="3" placeholder="Masukkan isi teks bacaan" required></textarea>
                        </div>
                        <button type="submit" class="btn w-100 text-white" style="background: #1CB2A2">Simpan Teks Bacaan</button>
                    </form>
                </div>
                <div class="card-body d-none" id="teksBacaanDisplay">
                    <h3 id="teksBacaanJudul" class="text-center"></h3>
                    <p id="teksBacaanIsi" class="text-justify"></p>
                </div>
            </div>
        </div>

        <!-- Card 2: Tambah Pertanyaan dan Jawaban Guru -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Tambah Pertanyaan dan Jawaban Guru</h4>
                </div>
                <div class="card-body">
                    <form id="formPasanganQa" method="POST" action="{{ route('pasangan-qa.store') }}">
                        @csrf
                        <input type="hidden" id="text_id" name="text_id">
                        <div id="qa-container">
                            <!-- Pasangan QA awal -->
                            <div class="qa-group mb-4" data-index="1">
                                <h5 class="qa-title">Soal 1</h5>
                                <div class="form-group d-flex align-items-center mb-2">
                                    <textarea class="form-control form-control-sm" name="pertanyaan[]" placeholder="Masukkan pertanyaan" rows="1" required disabled></textarea>
                                    <button type="button" class="btn btn-outline-success btn-sm rounded-circle ms-2 qa-add" onclick="addQaGroup()" disabled>+</button>
                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <textarea class="form-control form-control-sm" name="jawaban_guru[]" placeholder="Masukkan jawaban guru" rows="1" required disabled></textarea>
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-circle ms-2 qa-remove" onclick="removeQaGroup(this)" disabled>-</button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary w-100" disabled>Simpan Semua QA</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let qaIndex = 1;

    // Fungsi untuk menambahkan pasangan QA
    function addQaGroup() {
        qaIndex++;
        const qaContainer = document.getElementById('qa-container');

        // Buat elemen QA baru
        const newQaGroup = document.createElement('div');
        newQaGroup.classList.add('qa-group', 'mb-4');
        newQaGroup.setAttribute('data-index', qaIndex);
        newQaGroup.innerHTML = `
            <h5 class="qa-title">Soal ${qaIndex}</h5>
            <div class="form-group d-flex align-items-center mb-2">
                <textarea class="form-control form-control-sm" name="pertanyaan[]" placeholder="Masukkan pertanyaan" rows="1" required></textarea>
                <button type="button" class="btn btn-outline-success btn-sm rounded-circle ms-2 qa-add" onclick="addQaGroup()">+</button>
            </div>
            <div class="form-group d-flex align-items-center">
                <textarea class="form-control form-control-sm" name="jawaban_guru[]" placeholder="Masukkan jawaban guru" rows="1" required></textarea>
                <button type="button" class="btn btn-outline-danger btn-sm rounded-circle ms-2 qa-remove" onclick="removeQaGroup(this)">-</button>
            </div>
        `;

        // Tambahkan elemen baru ke kontainer
        qaContainer.appendChild(newQaGroup);

        // Perbarui nomor soal dan tombol "-"
        updateQaNumbers();
        updateRemoveButtons();
    }

    // Fungsi untuk menghapus pasangan QA
    function removeQaGroup(button) {
        const qaGroup = button.closest('.qa-group');
        qaGroup.remove();

        // Perbarui nomor soal dan tombol "-"
        updateQaNumbers();
        updateRemoveButtons();
    }

    // Fungsi untuk memperbarui nomor soal
    function updateQaNumbers() {
        const qaGroups = document.querySelectorAll('.qa-group');
        qaGroups.forEach((group, index) => {
            const title = group.querySelector('.qa-title');
            title.innerText = `Soal ${index + 1}`;
        });
        qaIndex = qaGroups.length;
    }

    // Fungsi untuk memperbarui tombol "-" agar dinonaktifkan jika hanya ada satu soal
    function updateRemoveButtons() {
        const qaGroups = document.querySelectorAll('.qa-group');
        qaGroups.forEach(group => {
            const removeButton = group.querySelector('.qa-remove');
            removeButton.disabled = qaGroups.length === 1;
        });
    }

    // Aktifkan form pasangan QA setelah teks bacaan disimpan
    document.getElementById('formTeksBacaan').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        try {
            const response = await fetch('{{ route("teks-bacaan.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: formData
            });

            if (response.ok) {
                const data = await response.json();

                // Tampilkan hasil teks bacaan
                document.getElementById('teksBacaanJudul').innerText = data.judul;
                document.getElementById('teksBacaanIsi').innerText = data.isi;

                // Sembunyikan form teks bacaan
                document.getElementById('teksBacaanForm').classList.add('d-none');
                document.getElementById('teksBacaanDisplay').classList.remove('d-none');

                // Set text_id untuk pasangan QA
                document.getElementById('text_id').value = data.text_id;

                // Aktifkan form QA
                const qaFormInputs = document.querySelectorAll('#formPasanganQa textarea, #formPasanganQa button');
                qaFormInputs.forEach(input => input.removeAttribute('disabled'));

                // Perbarui tombol "-" setelah aktivasi
                updateRemoveButtons();
            } else {
                alert('Gagal menyimpan teks bacaan. Silakan coba lagi.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        }
    });
</script>

@endsection
