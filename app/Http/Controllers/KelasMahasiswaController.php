<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mahasiswa;

class KelasMahasiswaController extends Controller
{
    public function index(Kelas $kelas)
    {
        if ($kelas->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $mahasiswa_di_kelas = $kelas->mahasiswa()->orderBy('nim', 'asc')->get();

        $mahasiswa_id_terdaftar = $mahasiswa_di_kelas->pluck('id')->toArray();

        $mahasiswa_tersedia = Mahasiswa::whereNotIn('id', $mahasiswa_id_terdaftar)
                                ->orderBy('nim', 'asc')
                                ->get();

        // Ambil daftar angkatan yang unik
        $daftar_angkatan = Mahasiswa::select('angkatan')->distinct()->orderBy('angkatan', 'desc')->get();

        return view('kelas.mahasiswa.index', compact('kelas', 'mahasiswa_di_kelas', 'mahasiswa_tersedia', 'daftar_angkatan'));
    }

    public function storeAngkatan(Request $request, Kelas $kelas)
    {
        if ($kelas->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'angkatan' => 'required|string|exists:mahasiswas,angkatan'
        ]);

        $mahasiswa_id_terdaftar = $kelas->mahasiswa()->pluck('mahasiswa_id')->toArray();

        $mahasiswa_baru = Mahasiswa::where('angkatan', $request->angkatan)
                                   ->whereNotIn('id', $mahasiswa_id_terdaftar)
                                   ->pluck('id')
                                   ->toArray();

        if (count($mahasiswa_baru) > 0) {
            $kelas->mahasiswa()->attach($mahasiswa_baru);
            return back()->with('success', count($mahasiswa_baru) . ' mahasiswa dari angkatan ' . $request->angkatan . ' berhasil ditambahkan.');
        }

        return back()->with('error', 'Semua mahasiswa dari angkatan ' . $request->angkatan . ' sudah ada di kelas ini.');
    }

    public function store(Request $request, Kelas $kelas)
    {
        if ($kelas->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id'
        ]);

        if (!$kelas->mahasiswa()->where('mahasiswa_id', $request->mahasiswa_id)->exists()) {
            $kelas->mahasiswa()->attach($request->mahasiswa_id);
            return back()->with('success', 'Mahasiswa berhasil ditambahkan ke kelas.');
        }

        return back()->with('error', 'Mahasiswa tersebut sudah ada di kelas ini.');
    }

    public function destroy(Kelas $kelas, Mahasiswa $mahasiswa)
    {
        if ($kelas->user_id !== auth()->id()) {
            abort(403);
        }

        $kelas->mahasiswa()->detach($mahasiswa->id);
        return back()->with('success', 'Mahasiswa berhasil dikeluarkan dari kelas.');
    }
}
