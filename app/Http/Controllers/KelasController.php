<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $kelas = $user->kelas()->orderBy('created_at', 'desc')->get();
        return view('kelas.index', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->kelas()->create([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dibuat!');
    }

    public function edit(Kelas $kelas)
    {
        if ($kelas->user_id !== auth()->id()) {
            abort(403);
        }
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        if ($kelas->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui!');
    }

    public function rekap(Kelas $kelas)
    {
        if ($kelas->user_id !== auth()->id()) {
            abort(403);
        }

        $mahasiswa = $kelas->mahasiswa()->orderBy('nim', 'asc')->get();
        $pertemuan = $kelas->pertemuan()->orderBy('tanggal', 'asc')->get();

        return view('kelas.rekap', compact('kelas', 'mahasiswa', 'pertemuan'));
    }

    public function destroy(Kelas $kelas)
    {
        if ($kelas->user_id !== auth()->id()) {
            abort(403);
        }

        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
