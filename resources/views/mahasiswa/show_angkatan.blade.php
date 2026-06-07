@extends('layouts.app')

@section('title', 'Daftar Mahasiswa Angkatan ' . $angkatan)

@section('content')
    <div class="mb-4">
        <a href="{{ route('mahasiswa.index') }}" class="text-decoration-none text-muted small">← Kembali ke Data Angkatan</a>
        <h2 class="fw-bold text-dark mt-2 mb-0">Daftar Mahasiswa: Angkatan {{ $angkatan }}</h2>
    </div>

    <div class="card mb-5 border-dashed bg-light">
        <h3 class="h5 fw-bold mb-3">➕ Tambah Mahasiswa Baru</h3>
        <form action="{{ route('mahasiswa.store') }}" method="POST" class="row g-4 align-items-end">
            @csrf
            <input type="hidden" name="angkatan" value="{{ $angkatan }}">
            <div class="col-md-3">
                <label for="nim" class="form-label small fw-semibold">NIM</label>
                <input type="text" name="nim" id="nim" class="form-control" placeholder="Masukkan NIM"
                    required>
            </div>
            <div class="col-md-6">
                <label for="nama" class="form-label small fw-semibold">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="form-control"
                    placeholder="Masukkan nama lengkap mahasiswa" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">🚀 Simpan Mahasiswa Baru</button>
            </div>
        </form>
    </div>

    <div class="card shadow-sm border-0">
        @if ($mahasiswa->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 80px;" class="text-center">No</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th style="width: 220px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $index => $m)
                            <tr>
                                <td class="text-center fw-medium text-muted">{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $m->nim }}</td>
                                <td>{{ $m->nama }}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('mahasiswa.edit', $m->id) }}"
                                            class="btn btn-warning btn-sm fw-bold text-dark flex-grow-1">
                                            ✏️ Edit
                                        </a>
                                        <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus data mahasiswa ini dari sistem?');"
                                            class="flex-grow-1 d-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100 fw-bold">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted mb-0">Belum ada data mahasiswa untuk angkatan {{ $angkatan }}.</p>
            </div>
        @endif
    </div>
@endsection
