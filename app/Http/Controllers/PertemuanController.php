<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pertemuan;

class PertemuanController extends Controller
{
    public function index(Kelas $kelas)
    {
        if ($kelas->user_id !== auth()->id()) {
            abort(403);
        }

        $pertemuan = $kelas->pertemuan()->orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
        return view('kelas.pertemuan.index', compact('kelas', 'pertemuan'));
    }

    public function store(Request $request, Kelas $kelas)
    {
        if ($kelas->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'tanggal' => 'required|date',
            'materi' => 'required|string|max:255',
        ]);

        $kelas->pertemuan()->create([
            'tanggal' => $request->tanggal,
            'materi' => $request->materi,
        ]);

        return redirect()->route('kelas.pertemuan.index', $kelas->id)->with('success', 'Jadwal pertemuan berhasil dibuat.');
    }

    public function edit(Kelas $kelas, Pertemuan $pertemuan)
    {
        if ($kelas->user_id !== auth()->id() || $pertemuan->kelas_id !== $kelas->id) {
            abort(403);
        }

        return view('kelas.pertemuan.edit', compact('kelas', 'pertemuan'));
    }

    public function update(Request $request, Kelas $kelas, Pertemuan $pertemuan)
    {
        if ($kelas->user_id !== auth()->id() || $pertemuan->kelas_id !== $kelas->id) {
            abort(403);
        }

        $request->validate([
            'tanggal' => 'required|date',
            'materi' => 'required|string|max:255',
        ]);

        $pertemuan->update([
            'tanggal' => $request->tanggal,
            'materi' => $request->materi,
        ]);

        return redirect()->route('kelas.pertemuan.index', $kelas->id)->with('success', 'Jadwal pertemuan berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas, Pertemuan $pertemuan)
    {
        if ($kelas->user_id !== auth()->id() || $pertemuan->kelas_id !== $kelas->id) {
            abort(403);
        }

        $pertemuan->delete();

        return redirect()->route('kelas.pertemuan.index', $kelas->id)->with('success', 'Jadwal pertemuan berhasil dihapus.');
    }
}
