<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\PasanganQa;
use App\Models\TeksBacaan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PembelajaranController extends Controller
{
    public function index()
    {
        // Ambil semua teks bacaan dari database
        $teksBacaan = TeksBacaan::all();
    
        // Kirim data ke view pembelajaran.index
        return view('pembelajaran.index', compact('teksBacaan'));
    }    

    public function show($text_id)
    {
        // Ambil teks bacaan berdasarkan text_id
        $teksBacaan = TeksBacaan::findOrFail($text_id);
    
        // Ambil pertanyaan yang terkait dengan text_id
        $pertanyaan = PasanganQa::where('text_id', $text_id)->get();
    
        // Ambil jawaban siswa yang terkait dengan user yang login dan text_id
        $jawaban = Jawaban::whereIn('qa_id', $pertanyaan->pluck('qa_id'))
            ->where('user_id', auth()->id())
            ->get();
    
        // Tampilkan ke halaman detail teks bacaan
        return view('pembelajaran.show', compact('teksBacaan', 'pertanyaan', 'jawaban'));
    }      

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'qa_ids' => 'required|array',
            'qa_ids.*' => 'exists:pasangan_qa,qa_id',
            'jawaban_siswa' => 'required|array',
            'jawaban_siswa.*' => 'required|string|max:1000',
        ]);
    
        // Iterasi dan simpan setiap jawaban siswa
        foreach ($request->qa_ids as $index => $qa_id) {
            Jawaban::create([
                'qa_id' => $qa_id,
                'user_id' => auth()->id(), // Mengambil user_id dari user yang sedang login
                'isi' => $request->jawaban_siswa[$index],
            ]);
        }
    
        return back()->with('success', 'Semua jawaban berhasil dikirim.');
    }
}
