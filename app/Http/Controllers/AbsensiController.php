<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pertemuan;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function index(Kelas $kelas, Pertemuan $pertemuan)
    {
        if ($kelas->user_id !== auth()->id() || $pertemuan->kelas_id !== $kelas->id) {
            abort(403);
        }

        $mahasiswa = $kelas->mahasiswa()->orderBy('nim', 'asc')->get();

        $absensi = Absensi::where('pertemuan_id', $pertemuan->id)->get()->keyBy('mahasiswa_id');

        return view('kelas.absensi.index', compact('kelas', 'pertemuan', 'mahasiswa', 'absensi'));
    }

    public function store(Request $request, Kelas $kelas, Pertemuan $pertemuan)
    {
        if ($kelas->user_id !== auth()->id() || $pertemuan->kelas_id !== $kelas->id) {
            abort(403);
        }

        $request->validate([
            'absensi' => 'required|array',
            'absensi.*.status' => 'required|in:hadir,izin,sakit,alpha',
            'absensi.*.keterangan' => 'nullable|string|max:255',
        ]);

        foreach ($request->absensi as $mahasiswa_id => $data) {
            Absensi::updateOrCreate(
                [
                    'pertemuan_id' => $pertemuan->id,
                    'mahasiswa_id' => $mahasiswa_id,
                ],
                [
                    'status' => $data['status'],
                    'keterangan' => $data['keterangan'] ?? null,
                ]
            );
        }

        return redirect()->route('kelas.pertemuan.index', $kelas->id)->with('success', 'Data absensi berhasil disimpan.');
    }
}
