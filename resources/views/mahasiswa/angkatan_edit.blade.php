@extends('layouts.app')

@section('title', 'Edit Tahun Angkatan')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-6 col-lg-5">
        <div class="mb-4">
            <a href="{{ route('mahasiswa.index') }}" class="text-decoration-none text-muted small">← Kembali ke Data Mahasiswa</a>
            <h2 class="fw-bold text-dark mt-2 mb-0">Edit Tahun Angkatan</h2>
            <p class="text-muted small mt-1">Mengubah tahun akan memperbarui seluruh data mahasiswa di angkatan ini.</p>
        </div>

        <div class="card shadow-sm border-0 p-4">
            <form action="{{ route('mahasiswa.angkatan.update', $angkatan->tahun) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="tahun" class="form-label fw-bold small">Tahun Angkatan</label>
                    <input type="text" name="tahun" id="tahun" class="form-control" value="{{ old('tahun', $angkatan->tahun) }}" required autofocus>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary flex-grow-1 py-2 fw-bold">💾 Simpan Perubahan</button>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-dark flex-grow-1 py-2 fw-bold">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
