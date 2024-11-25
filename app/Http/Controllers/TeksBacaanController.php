<?php

namespace App\Http\Controllers;

use App\Models\TeksBacaan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class TeksBacaanController extends Controller
{
    public function index()
    {
        // Ambil data teks bacaan dan jumlah pembaca
        $teksBacaan = TeksBacaan::with(['pasanganQa'])
            ->withCount([
                'pasanganQa as jumlah_pembaca' => function ($query) {
                    $query->join('jawaban', 'pasangan_qa.qa_id', '=', 'jawaban.qa_id')
                        ->select(DB::raw('count(jawaban.qa_id)'));
                },
            ])
            ->get();
    
        return view('teks-bacaan.index', compact('teksBacaan'));
    }   


    public function create()
    {
        return view('teks-bacaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $teksBacaan = \App\Models\TeksBacaan::create($request->only('judul', 'isi'));

        return response()->json($teksBacaan, 201);
    }

    public function detail($text_id)
    {
        // Ambil data teks bacaan berdasarkan text_id
        $teksBacaan = TeksBacaan::findOrFail($text_id);
    
        // Ambil data user_id yang menjawab pertanyaan berdasarkan text_id dari tabel jawaban
        $jawabanUsers = DB::table('jawaban')
            ->join('pasangan_qa', 'jawaban.qa_id', '=', 'pasangan_qa.qa_id')
            ->where('pasangan_qa.text_id', $text_id)
            ->select('jawaban.created_at as tanggal', 'jawaban.user_id')
            ->orderBy('jawaban.created_at', 'desc')
            ->get();
    
        return view('teks-bacaan.detail', compact('teksBacaan', 'jawabanUsers'));
    }
    

}
