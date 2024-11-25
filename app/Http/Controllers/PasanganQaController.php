<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasanganQa;

class PasanganQaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'text_id' => 'required|exists:teks_bacaan,text_id',
            'pertanyaan.*' => 'required|string',
            'jawaban_guru.*' => 'required|string',
        ]);
    
        foreach ($request->pertanyaan as $index => $pertanyaan) {
            \App\Models\PasanganQa::create([
                'text_id' => $request->text_id,
                'pertanyaan' => $pertanyaan,
                'jawaban_guru' => $request->jawaban_guru[$index],
            ]);
        }
    
        return redirect()->back()->with('success', 'Semua pasangan QA berhasil disimpan!');
    }    
}
