<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psy\Command\WhereamiCommand;

class UjianController extends Controller
{
    public function index()
    {
        $dataWaktuUjian = Ujian::all();
        $dataMatkul = MataKuliah::all();
        return view('pages.assasmentttime.index', compact('dataWaktuUjian', 'dataMatkul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'durasi_ujian' => 'required|numeric|min:30',
            'tanggal_ujian' => 'required|date|after_or_equal:today',
        ]);


        Ujian::create([
            'mata_kuliah_id' =>  $request->mata_kuliah_id,
            'durasi_ujian' =>  $request->durasi_ujian,
            'tanggal_ujian' =>  $request->tanggal_ujian,
        ]);

        return redirect()->route('pages.indexUjian')->with('success', 'Data ujian berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $dataAssasment = Ujian::findOrFail($id);
        $dataMatkul = MataKuliah::all();
        $dataDetailMatkul = MataKuliah::find($dataAssasment->mata_kuliah_id);

        
        return view('pages.assasmentttime.show', compact('dataAssasment', 'dataMatkul',  'dataDetailMatkul'));
    }

    public function update(Request $request, string $id)
    {
        // Validasi input data
        $validated = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'durasi_ujian' => 'required|integer|min:30',
            'tanggal_ujian' => 'required|date',
        ]);

        // Menemukan ujian berdasarkan ID
        $ujian = Ujian::findOrFail($id);

        // Melakukan update data ujian
        $ujian->update([
            'mata_kuliah_id' => $validated['mata_kuliah_id'],
            'durasi_ujian' => $validated['durasi_ujian'],
            'tanggal_ujian' => $validated['tanggal_ujian'],
        ]);

        // Mengarahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('pages.indexUjian')->with('success', 'Data ujian berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $ujian = Ujian::findOrFail($id);
        $ujian->delete();
        return redirect()->route('pages.indexUjian')->with('success', 'Data ujian berhasil dihapus.');
    }
}
