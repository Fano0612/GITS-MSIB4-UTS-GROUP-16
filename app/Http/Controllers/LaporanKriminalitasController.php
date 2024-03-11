<?php

namespace App\Http\Controllers;

use App\Models\LaporanKriminalitas;
use Illuminate\Http\Request;

class LaporanKriminalitasController extends Controller
{
    public function index()
    {
        $laporan = LaporanKriminalitas::all();
        return view('laporankriminalitas', compact('laporan'));
    }

    public function insertlaporan(Request $request)
    {
        $validatedData = $request->validate([
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'deskripsi.required' => 'Deskripsi kosong, silakan mengisikan kolom deskripsi!',
            'foto.required' => 'Foto kosong, silakan mengisikan kolom foto!',
        ]);
        $fotoPath = '';
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto');
            $imageName = time() . '.' . $fotoPath->getClientOriginalExtension();
            $fotoPath->move(public_path('images/fotolaporan'), $imageName);
            $fotoPath = $imageName;
        }

        LaporanKriminalitas::create([
            'username' => auth()->user()->username,
            'deskripsi' => $validatedData['deskripsi'],
            'foto' => $fotoPath,
            'statuspelaporan' => 'Dalam Peninjauan',
        ]);

        return redirect()->back()->with('success', 'Laporan kriminalitas berhasil ditambahkan.');
    }

    public function showlaporan($id)
    {
        $laporan = LaporanKriminalitas::findOrFail($id);
        return view('laporan.show', compact('laporan'));
    }

    public function editlaporan(Request $request, $id)
    {

        $request->validate([
            'deskripsi' => 'required',
        ]);

        $laporan = LaporanKriminalitas::findOrFail($id);
        $laporan->update([
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Laporan kriminalitas berhasil diperbarui.');
    }

    public function deletelaporan($id)
    {
        $laporan = LaporanKriminalitas::findOrFail($id);
        $laporan->delete();
        return redirect()->back()->with('success', 'Laporan kriminalitas berhasil dihapus.');
    }
}
