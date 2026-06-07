@extends('layouts.app')

@section('title', 'Data Induk Mahasiswa')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold text-dark mb-1">Data Induk Mahasiswa</h2>
        <p class="text-muted">Kelola data mahasiswa per tahun angkatan.</p>
    </div>

    <div class="card mb-5 border-dashed bg-light">
        <h3 class="h5 fw-bold mb-3">➕ Buat Kotak Angkatan Baru</h3>
        <form action="{{ route('mahasiswa.angkatan.store') }}" method="POST" class="row g-3 align-items-end">
            @csrf
            <div class="col-md-9">
                <label for="tahun" class="form-label small fw-semibold">Tahun Angkatan</label>
                <input type="text" name="tahun" id="tahun" class="form-control"
                    placeholder="Masukkan Tahun (Contoh: 2025)" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success w-100">🚀 Buat Kotak Angkatan</button>
            </div>
        </form>
    </div>

    @if ($angkatanList->count() > 0)
        <div class="row g-4">
            @foreach ($angkatanList as $a)
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 shadow-sm border-0 text-center p-4">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 80px; height: 80px; font-size: 2rem;">
                            🎓
                        </div>

                        <h3 class="h4 fw-bold text-dark mb-1">Angkatan {{ $a->tahun }}</h3>
                        <p class="text-muted mb-4 small fw-medium">{{ $a->total }} Mahasiswa Terdaftar</p>

                        <div class="d-grid gap-2">
                            <a href="{{ route('mahasiswa.angkatan', $a->tahun) }}"
                                class="btn btn-primary px-3 py-2 fw-bold">
                                📄 Lihat Daftar Mahasiswa
                            </a>

                            <div class="d-flex gap-2 mt-2">
                                <a href="{{ route('mahasiswa.angkatan.edit', $a->tahun) }}"
                                    class="btn btn-warning btn-sm flex-grow-1 fw-bold text-dark">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('mahasiswa.angkatan.destroy', $a->tahun) }}" method="POST"
                                    onsubmit="return confirm('Hapus kotak angkatan {{ $a->tahun }}?');"
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
    @endif
@endsection
