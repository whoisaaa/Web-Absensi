@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('content')
    <div style="margin-bottom: 2rem;">
        <h2 style="margin: 0; color: #1f2937;">Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p style="color: #6b7280; margin-top: 0.25rem;">Berikut adalah ringkasan data absensi Anda hari ini.</p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div
                class="card h-100 d-flex flex-row align-items-center gap-3 border-0 border-start border-5 border-primary shadow-sm">
                <div class="rounded-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary"
                    style="width: 60px; height: 60px; font-size: 1.75rem;">
                    🏫
                </div>
                <div>
                    <p class="text-secondary mb-0 small fw-bold text-uppercase">Total Kelas</p>
                    <h3 class="fw-bold mb-0">{{ $totalKelas }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div
                class="card h-100 d-flex flex-row align-items-center gap-3 border-0 border-start border-5 border-success shadow-sm">
                <div class="rounded-3 d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success"
                    style="width: 60px; height: 60px; font-size: 1.75rem;">
                    👥
                </div>
                <div>
                    <p class="text-secondary mb-0 small fw-bold text-uppercase">Data Mahasiswa</p>
                    <h3 class="fw-bold mb-0">{{ $totalMahasiswa }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div
                class="card h-100 d-flex flex-row align-items-center gap-3 border-0 border-start border-5 border-warning shadow-sm">
                <div class="rounded-3 d-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning"
                    style="width: 60px; height: 60px; font-size: 1.75rem;">
                    📅
                </div>
                <div>
                    <p class="text-secondary mb-0 small fw-bold text-uppercase">Total Pertemuan</p>
                    <h3 class="fw-bold mb-0">{{ $totalPertemuan }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-7">
            <div class="card h-100 bg-light border-dashed">
                <h5 class="text-muted mb-3">Akses Cepat Manajemen</h5>
                <div class="d-flex gap-3">
                    <a href="{{ route('kelas.index') }}" class="btn btn-primary flex-grow-1">📂 Kelola Kelas</a>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-success flex-grow-1">📝 Data Mahasiswa</a>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card h-100 bg-light d-flex align-items-center justify-content-center">
                <p class="text-muted fst-italic text-center mb-0">
                    "Sistem absensi membantu Anda memantau kedisiplinan mahasiswa dengan lebih efisien."
                </p>
            </div>
        </div>
    </div>
@endsection
