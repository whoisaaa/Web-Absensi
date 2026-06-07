@extends('layouts.app')

@section('title', 'Mengelola Kelas')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Daftar Kelas Anda</h2>
        <p class="text-muted">Kelola data mahasiswa, pertemuan, dan rekap absensi pada masing-masing kelas.</p>
    </div>

    <div class="card mb-5 border-dashed bg-light">
        <h3 class="h5 fw-bold mb-3">➕ Buat Kelas Baru</h3>
        <form action="{{ route('kelas.store') }}" method="POST" class="row g-3 align-items-end">
            @csrf
            <div class="col-md-9">
                <label for="nama_kelas" class="form-label small fw-semibold">Nama Kelas (Contoh: Pemrograman Web - A)</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control"
                    placeholder="Masukkan nama mata kuliah / kelas" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">🚀 Simpan Kelas Baru</button>
            </div>
        </form>
    </div>

    @if ($kelas->count() > 0)
        <div class="row g-4">
            @foreach ($kelas as $k)
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="mb-4">
                            <h3 class="h5 fw-bold text-dark mb-2">{{ $k->nama_kelas }}</h3>
                            <div class="bg-primary rounded" style="height: 3px; width: 40px;"></div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('kelas.mahasiswa.index', $k->id) }}"
                                class="btn btn-outline-primary text-start px-3 py-2">
                                <span class="me-2">👥</span> Data Mahasiswa
                            </a>
                            <a href="{{ route('kelas.pertemuan.index', $k->id) }}"
                                class="btn btn-outline-success text-start px-3 py-2">
                                <span class="me-2">📅</span> Jadwal & Absensi
                            </a>
                            <a href="{{ route('kelas.rekap', $k->id) }}" class="btn btn-outline-dark text-start px-3 py-2"
                                style="border-color: #7c3aed; color: #7c3aed;">
                                <span class="me-2">📊</span> Rekap Absensi
                            </a>

                            <div class="d-flex gap-2 mt-2">
                                <a href="{{ route('kelas.edit', $k->id) }}"
                                    class="btn btn-warning btn-sm flex-grow-1 fw-bold text-dark">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('kelas.destroy', $k->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus kelas ini? Semua data pertemuan dan absensi akan ikut terhapus!');"
                                    class="flex-grow-1 d-flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100 fw-bold">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card text-center py-5">
            <p class="text-muted mb-0">Anda belum memiliki kelas. Silakan buat kelas baru menggunakan formulir di atas.</p>
        </div>
    @endif
@endsection
