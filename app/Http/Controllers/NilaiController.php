<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeksBacaan;
use App\Models\PasanganQa;
use App\Models\Jawaban;

class NilaiController extends Controller
{
    public function show($text_id, $user_id)
    {
        // Ambil teks bacaan berdasarkan text_id
        $teksBacaan = TeksBacaan::findOrFail($text_id);

        // Ambil pertanyaan dan jawaban siswa berdasarkan text_id dan user_id
        $pertanyaan = PasanganQa::where('text_id', $text_id)->get();
        $jawabanSiswa = Jawaban::whereIn('qa_id', $pertanyaan->pluck('qa_id'))
            ->where('user_id', $user_id)
            ->get();

        return view('nilai.show', compact('teksBacaan', 'pertanyaan', 'jawabanSiswa', 'user_id'));
    }

    public function store(Request $request, $text_id, $user_id)
    {
        // Validasi input nilai
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'nullable|integer|min:0|max:100',
        ]);
    
        // Update nilai untuk setiap jawaban
        foreach ($request->nilai as $qa_id => $nilai) {
            Jawaban::where('qa_id', $qa_id)
                ->where('user_id', $user_id)
                ->update(['nilai' => $nilai]);
        }
    
        // Redirect kembali ke halaman nilai dengan pesan sukses
        return redirect()->route('nilai.show', [$text_id, $user_id])
            ->with('success', 'Nilai berhasil disimpan.');
    }    
}
