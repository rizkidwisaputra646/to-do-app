<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::all();
        return view('tugas.index', compact('tugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tugas' => 'required|string|max:255'
        ]);

        Tugas::create([
            'nama_tugas' => $request->nama_tugas,
            'is_completed' => false
        ]);

        return redirect()->route('tugas.index');
    }


    public function update(Request $request, Tugas $tugas)
    {
        // kalau request bawa nama_tugas → EDIT
        if ($request->has('nama_tugas')) {
            $request->validate([
                'nama_tugas' => 'required|string|max:255'
            ]);

            $tugas->update([
                'nama_tugas' => $request->nama_tugas
            ]);
        } 
        // kalau tidak → TOGGLE selesai
        else {
            $tugas->update([
                'is_completed' => !$tugas->is_completed
            ]);
        }

        return redirect()->route('tugas.index');
    }

}
