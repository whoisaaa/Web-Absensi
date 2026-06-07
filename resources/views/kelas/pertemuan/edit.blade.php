@extends('layouts.app')

@section('title', 'Edit Pertemuan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="mb-4">
            <a href="{{ route('kelas.pertemuan.index', $kelas->id) }}" class="text-decoration-none text-muted small">← Kembali ke Jadwal Pertemuan</a>
            <h2 class="fw-bold text-dark mt-2 mb-0">Edit Jadwal Pertemuan</h2>
            <p class="text-muted small">Kelas: <span class="fw-bold text-dark">{{ $kelas->nama_kelas }}</span></p>
        </div>

        <div class="card shadow-sm border-0 p-4">
            <form action="{{ route('pertemuan.update', [$kelas->id, $pertemuan->id]) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="tanggal" class="form-label fw-bold small">Tanggal Pertemuan</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $pertemuan->tanggal) }}" required>
                </div>

                <div class="mb-4">
                    <label for="materi" class="form-label fw-bold small">Materi / Topik Pembahasan</label>
                    <input type="text" name="materi" id="materi" class="form-control" value="{{ old('materi', $pertemuan->materi) }}" required>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary flex-grow-1 py-2 fw-bold">💾 Simpan Perubahan</button>
                    <a href="{{ route('kelas.pertemuan.index', $kelas->id) }}" class="btn btn-outline-dark flex-grow-1 py-2 fw-bold">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
