<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\PenugasanPIC;
use App\Models\PIC;
use Illuminate\Http\Request;

class PenugasanPICController extends Controller
{
    public function index()
    {
        $dataPenugasan = PenugasanPIC::all();
        $dataPIC = PIC::all();
        $dataMatkul = MataKuliah::whereNotIn('id', PenugasanPIC::pluck('mata_kuliah_id')->toArray())->get();
        return view('pages.picmanagement.index', compact('dataPenugasan', 'dataPIC', 'dataMatkul'));
    }

    public function  show(string $id)
    {
        $dataPenugasan = PenugasanPIC::findOrFail($id);
        $dataPIC = PIC::all();
        $dataMatkul = MataKuliah::whereNotIn('id', PenugasanPIC::pluck('mata_kuliah_id')->toArray())->get();
        $dataDetailMatkul = MataKuliah::find($dataPenugasan->mata_kuliah_id);
        $dataDetailPIC = PIC::find($dataPenugasan->pic_user_id);

        return view('pages.picmanagement.show', compact('dataPenugasan', 'dataPIC', 'dataMatkul', 'dataDetailMatkul', 'dataDetailPIC'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari request
        $request->validate([
            'pic_user_id' => 'required|exists:pic_user,id',  // Pastikan PIC valid
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',  // Pastikan Mata Kuliah valid
            'deadline' => 'nullable|date',  // Validasi deadline (optional)
            'status' => 'nullable|string|max:50',  // Validasi status (optional)
        ]);

        // Temukan penugasan berdasarkan ID
        $penugasan = PenugasanPIC::findOrFail($id);

        // Update data penugasan
        $penugasan->pic_user_id = $request->pic_user_id;
        $penugasan->mata_kuliah_id = $request->mata_kuliah_id;
        $penugasan->deadline = $request->deadline;
        $penugasan->status = $request->status ?? 'pending';  // Default status 'pending' jika kosong

        // Simpan perubahan
        $penugasan->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('pages.indexPenugasan')->with('success', 'Penugasan berhasil diperbarui!');
    }


    public function store(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'pic_user_id' => 'required|exists:pic_user,id',  // Pastikan PIC valid
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',  // Pastikan Mata Kuliah valid
            'deadline' => 'nullable|date',  // Validasi deadline (optional)
            'status' => 'nullable|string|max:50',  // Validasi status (optional)
        ]);

        // Cek apakah mata kuliah sudah ada yang terdaftar untuk PIC yang sama
        $existingPenugasan = PenugasanPIC::where('mata_kuliah_id', $request->mata_kuliah_id)
            ->exists();

        if ($existingPenugasan) {
            // Jika mata kuliah sudah digunakan, beri response error
            return back()->withErrors(['mata_kuliah_id' => 'Mata kuliah ini sudah digunakan.']);
        }

        // Simpan penugasan baru
        $penugasan = new PenugasanPIC();
        $penugasan->pic_user_id = $request->pic_user_id;
        $penugasan->mata_kuliah_id = $request->mata_kuliah_id;
        $penugasan->deadline = $request->deadline;
        $penugasan->status = $request->status ?? 'pending';  // Default status 'pending' jika kosong
        $penugasan->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('pages.indexPenugasan')->with('success', 'Penugasan berhasil disimpan!');
    }

    public function destroy($id)
    {
        // Temukan penugasan berdasarkan ID
        $penugasan = PenugasanPIC::findOrFail($id);

        // Hapus penugasan
        $penugasan->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('pages.indexPenugasan')->with('success', 'Penugasan berhasil dihapus!');
    }
}
