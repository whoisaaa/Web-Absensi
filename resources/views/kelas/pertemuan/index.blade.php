@extends('layouts.app')

@section('title', 'Jadwal Pertemuan: ' . $kelas->nama_kelas)

@section('content')
    <div class="mb-4">
        <a href="{{ route('kelas.index') }}" class="text-decoration-none text-muted small">← Kembali ke Daftar Kelas</a>
        <h2 class="fw-bold text-dark mt-2 mb-0">Jadwal Pertemuan: {{ $kelas->nama_kelas }}</h2>
    </div>

    <div class="card mb-5 border-dashed bg-light">
        <h3 class="h5 fw-bold mb-3">➕ Tambah Jadwal Pertemuan</h3>
        <form action="{{ route('kelas.pertemuan.store', $kelas->id) }}" method="POST" class="row g-4 align-items-end">
            @csrf
            <div class="col-md-3">
                <label for="tanggal" class="form-label small fw-semibold">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" class="form-control"
                    required>
            </div>
            <div class="col-md-6">
                <label for="materi" class="form-label small fw-semibold">Materi / Topik Pembahasan</label>
                <input type="text" name="materi" id="materi" class="form-control"
                    placeholder="Masukkan materi pertemuan" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success w-100">🚀 Simpan Pertemuan Baru</button>
            </div>
        </form>
    </div>

    @if ($pertemuan->count() > 0)
        <div class="row g-4">
            @foreach ($pertemuan as $index => $p)
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 shadow-sm border-0 p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge rounded-pill bg-light text-dark px-3 py-2 fw-bold">
                                Pertemuan {{ $index + 1 }}
                            </span>
                            <span class="text-muted small fw-medium">
                                {{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}
                            </span>
                        </div>

                        <div class="mb-4 flex-grow-1">
                            <h3 class="h5 fw-bold text-dark lh-base mb-0">
                                {{ $p->materi }}
                            </h3>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('kelas.absensi.index', [$kelas->id, $p->id]) }}"
                                class="btn btn-primary px-3 py-2 fw-bold">
                                📝 Isi Absensi
                            </a>

                            <div class="d-flex gap-2 mt-1">
                                <a href="{{ route('pertemuan.edit', [$kelas->id, $p->id]) }}"
                                    class="btn btn-warning btn-sm flex-grow-1 fw-bold text-dark">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('pertemuan.destroy', [$kelas->id, $p->id]) }}" method="POST"
                                    onsubmit="return confirm('Hapus jadwal pertemuan ini?');" class="flex-grow-1 d-flex">
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
            <p class="text-muted mb-0">Belum ada jadwal pertemuan untuk kelas ini. Silakan tambah jadwal menggunakan
                formulir di atas.</p>
        </div>
    @endif
@endsection
