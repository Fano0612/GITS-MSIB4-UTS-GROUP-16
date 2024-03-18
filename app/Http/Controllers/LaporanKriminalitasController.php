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
        $laporan = LaporanKriminalitas::find($id);
        return view('daftarlaporankriminalitasupdate', compact('laporan'));
    }

    public function editlaporan(Request $request, $id)
    {

        $laporan = LaporanKriminalitas::find($id);
        $validatedData = $request->validate([
            'id_pelaporankegiatankriminalitas' => 'nullable',
            'username' => 'nullable',
            'deskripsi' => 'nullable',
            'statuspelaporan' => 'nullable',

        ]);


        if ($laporan) {
            $laporan->update([
                'id_pelaporankegiatankriminalitas' => $validatedData['id_pelaporankegiatankriminalitas'],
                'username' => $validatedData['username'],
                'deskripsi' => $validatedData['deskripsi'],
                'statuspelaporan' => $validatedData['statuspelaporan'],
            ]);

            
                $laporan->save();

            return redirect()->route('daftarlaporankriminalitas')->with(['laporan' => $laporan]);
        } else {
            return redirect()->route('daftarlaporankriminalitas')->with('error', 'Data Not Found');
        }
    }

    public function deletelaporan($id)
    {
        $laporan = LaporanKriminalitas::findOrFail($id);
        $laporan->delete();
        return redirect()->back()->with('success', 'Laporan kriminalitas berhasil dihapus.');
    }

    public function showlaporan2($id)
    {
        $laporan = LaporanKriminalitas::find($id);
        return view('daftarlaporankriminalitasupdate2', compact('laporan'));
    }

    public function editlaporan2(Request $request, $id)
    {

        $laporan = LaporanKriminalitas::find($id);
        $validatedData = $request->validate([
            'id_pelaporankegiatankriminalitas' => 'nullable',
            'username' => 'nullable',
            'deskripsi' => 'nullable',
            'statuspelaporan' => 'nullable',

        ]);


        if ($laporan) {
            $laporan->update([
                'id_pelaporankegiatankriminalitas' => $validatedData['id_pelaporankegiatankriminalitas'],
                'username' => $validatedData['username'],
                'deskripsi' => $validatedData['deskripsi'],
                'statuspelaporan' => $validatedData['statuspelaporan'],
            ]);

            
                $laporan->save();

            return redirect()->route('daftarlaporankriminalitas2')->with(['laporan' => $laporan]);
        } else {
            return redirect()->route('daftarlaporankriminalitas2')->with('error', 'Data Not Found');
        }
    }

    public function deletelaporan2($id)
    {
        $laporan = LaporanKriminalitas::findOrFail($id);
        $laporan->delete();
        return redirect()->back()->with('success', 'Laporan kriminalitas berhasil dihapus.');
    }
}
