@extends('layouts.app')

@section('title', 'Edit Kelas')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="mb-4">
            <a href="{{ route('kelas.index') }}" class="text-decoration-none text-muted small">← Kembali ke Daftar Kelas</a>
            <h2 class="fw-bold text-dark mt-2 mb-0">Edit Nama Kelas</h2>
        </div>

        <div class="card shadow-sm border-0 p-4">
            <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="nama_kelas" class="form-label fw-bold small">Nama Kelas</label>
                    <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required autofocus>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary flex-grow-1 py-2 fw-bold">💾 Simpan Perubahan</button>
                    <a href="{{ route('kelas.index') }}" class="btn btn-outline-dark flex-grow-1 py-2 fw-bold">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
