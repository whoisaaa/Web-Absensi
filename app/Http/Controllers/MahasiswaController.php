<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        $angkatanList = \App\Models\Angkatan::orderBy('tahun', 'desc')->get();
        
        foreach($angkatanList as $a) {
            $a->total = Mahasiswa::where('angkatan', $a->tahun)->count();
        }
            
        return view('mahasiswa.index', compact('angkatanList'));
    }

    public function storeAngkatan(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string|max:4|unique:angkatans,tahun',
        ], [
            'tahun.unique' => 'Angkatan ini sudah terdaftar.',
        ]);

        \App\Models\Angkatan::create([
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Kotak Angkatan ' . $request->tahun . ' berhasil dibuat!');
    }

    public function destroyAngkatan($tahun)
    {
        $angkatan = \App\Models\Angkatan::where('tahun', $tahun)->firstOrFail();
        
        if (Mahasiswa::where('angkatan', $tahun)->exists()) {
            return redirect()->route('mahasiswa.index')->with('error', 'Hanya angkatan kosong yang bisa dihapus. Pindahkan atau hapus mahasiswanya terlebih dahulu.');
        }

        $angkatan->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Angkatan ' . $tahun . ' berhasil dihapus!');
    }

    public function editAngkatan($tahun)
    {
        $angkatan = \App\Models\Angkatan::where('tahun', $tahun)->firstOrFail();
        return view('mahasiswa.angkatan_edit', compact('angkatan'));
    }

    public function updateAngkatan(Request $request, $tahun)
    {
        $angkatan = \App\Models\Angkatan::where('tahun', $tahun)->firstOrFail();
        
        $request->validate([
            'tahun' => 'required|string|max:4|unique:angkatans,tahun,' . $angkatan->id,
        ]);

        $newTahun = $request->tahun;
        
        Mahasiswa::where('angkatan', $tahun)->update(['angkatan' => $newTahun]);
        
        $angkatan->update(['tahun' => $newTahun]);

        return redirect()->route('mahasiswa.index')->with('success', 'Angkatan berhasil diperbarui dari ' . $tahun . ' menjadi ' . $newTahun);
    }

    public function showAngkatan($angkatan)
    {
        $mahasiswa = Mahasiswa::where('angkatan', $angkatan)
            ->orderBy('nim', 'asc')
            ->get();
            
        return view('mahasiswa.show_angkatan', compact('mahasiswa', 'angkatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|unique:mahasiswas,nim|max:20',
            'nama' => 'required|string|max:255',
            'angkatan' => 'required|string|max:4',
        ], [
            'nim.unique' => 'NIM ini sudah terdaftar di sistem.',
        ]);

        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
        ]);

        return redirect()->route('mahasiswa.angkatan', $request->angkatan)->with('success', 'Data Mahasiswa berhasil ditambahkan!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:255',
            'angkatan' => 'required|string|max:4',
        ]);

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
        ]);

        return redirect()->route('mahasiswa.angkatan', $mahasiswa->angkatan)->with('success', 'Data Mahasiswa berhasil diperbarui!');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.angkatan', $mahasiswa->angkatan)->with('success', 'Data Mahasiswa berhasil dihapus!');
    }
}
