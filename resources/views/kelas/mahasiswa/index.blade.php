@extends('layouts.app')

@section('title', 'Mahasiswa di Kelas ' . $kelas->nama_kelas)

@section('content')
    <div class="mb-4">
        <a href="{{ route('kelas.index') }}" class="text-decoration-none text-muted small">← Kembali ke Daftar Kelas</a>
        <h2 class="fw-bold text-dark mt-2 mb-0">Manajemen Mahasiswa: {{ $kelas->nama_kelas }}</h2>
    </div>

    <div class="card mb-4 border-0 shadow-sm p-4">
        <div class="row g-5">
            <div class="col-md-6 border-end">
                <h4 class="h6 fw-bold text-muted text-uppercase mb-3">Tambah Per Mahasiswa</h4>
                <form method="POST" action="{{ route('kelas.mahasiswa.store', $kelas->id) }}"
                    class="d-flex flex-column gap-3">
                    @csrf
                    <div>
                        <label for="mahasiswa_id" class="form-label small fw-semibold text-dark">Cari Mahasiswa</label>
                        <select id="mahasiswa_id" name="mahasiswa_id" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                            @foreach ($mahasiswa_tersedia as $m)
                                <option value="{{ $m->id }}">{{ $m->nim }} - {{ $m->nama }} (Angkatan
                                    {{ $m->angkatan }})</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold"
                        @if ($mahasiswa_tersedia->count() == 0) disabled @endif>
                        ➕ Tambahkan ke Kelas
                    </button>
                </form>
                @if ($mahasiswa_tersedia->count() == 0)
                    <p class="text-muted small mt-2 mb-0 italic">Semua mahasiswa di data induk sudah terdaftar.</p>
                @endif
            </div>

            <div class="col-md-6">
                <h4 class="h6 fw-bold text-muted text-uppercase mb-3">Tambah Sekaligus 1 Angkatan</h4>
                <form method="POST" action="{{ route('kelas.mahasiswa.storeAngkatan', $kelas->id) }}"
                    class="d-flex flex-column gap-3">
                    @csrf
                    <div>
                        <label for="angkatan" class="form-label small fw-semibold text-dark">Pilih Tahun Angkatan</label>
                        <select id="angkatan" name="angkatan" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Tahun --</option>
                            @foreach ($daftar_angkatan as $a)
                                <option value="{{ $a->angkatan }}">{{ $a->angkatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100 fw-bold">
                        🚀 Tambahkan Semua Angkatan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 overflow-hidden">
        <div class="card-header bg-white py-3 border-bottom">
            <h3 class="h6 fw-bold mb-0 text-dark">Daftar Mahasiswa di Kelas Ini</h3>
        </div>

        @if ($mahasiswa_di_kelas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 80px;" class="text-center">No</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th class="text-center">Angkatan</th>
                            <th style="width: 180px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa_di_kelas as $index => $m)
                            <tr>
                                <td class="text-center text-muted fw-medium">{{ $index + 1 }}</td>
                                <td class="fw-bold text-dark">{{ $m->nim }}</td>
                                <td>{{ $m->nama }}</td>
                                <td class="text-center"><span
                                        class="badge bg-light text-dark border">{{ $m->angkatan }}</span></td>
                                <td class="text-center">
                                    <form method="POST"
                                        action="{{ route('kelas.mahasiswa.destroy', [$kelas->id, $m->id]) }}"
                                        onsubmit="return confirm('Yakin ingin mengeluarkan mahasiswa ini dari kelas?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-link text-danger text-decoration-none fw-bold p-0">Hapus dari
                                            Kelas</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted mb-0">Belum ada mahasiswa di kelas ini.</p>
            </div>
        @endif
    </div>
@endsection
