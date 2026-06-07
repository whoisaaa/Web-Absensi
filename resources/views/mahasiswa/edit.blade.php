@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="mb-4">
            <a href="{{ route('mahasiswa.index') }}" class="text-decoration-none text-muted small">← Kembali ke Data Induk</a>
            <h2 class="fw-bold text-dark mt-2 mb-0">Edit Data Mahasiswa</h2>
        </div>

        <div class="card shadow-sm border-0 p-4">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nim" class="form-label fw-bold small">NIM</label>
                    <input type="text" name="nim" id="nim" class="form-control" value="{{ old('nim', $mahasiswa->nim) }}" required>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold small">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $mahasiswa->nama) }}" required>
                </div>

                <input type="hidden" name="angkatan" value="{{ $mahasiswa->angkatan }}">


                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary flex-grow-1 py-2 fw-bold">💾 Simpan Perubahan</button>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-dark flex-grow-1 py-2 fw-bold">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
