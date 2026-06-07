@extends('layouts.app')

@section('title', 'Isi Absensi: ' . \Carbon\Carbon::parse($pertemuan->tanggal)->format('d M Y'))

@section('content')
<div class="mb-4">
    <a href="{{ route('kelas.pertemuan.index', $kelas->id) }}" class="text-decoration-none text-muted small">← Kembali ke Jadwal Pertemuan</a>
    <h2 class="fw-bold text-dark mt-2 mb-0">Pengisian Absensi Kelas {{ $kelas->nama_kelas }}</h2>
    <p class="text-muted mt-1">
        Tanggal: <span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($pertemuan->tanggal)->format('d F Y') }}</span> | 
        Materi: <span class="fw-bold text-dark">{{ $pertemuan->materi }}</span>
    </p>
</div>

<div class="card shadow-sm border-0 overflow-hidden">
    <form method="POST" action="{{ route('kelas.absensi.store', [$kelas->id, $pertemuan->id]) }}">
        @csrf
        
        @if($mahasiswa->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px;" class="text-center">No</th>
                            <th style="width: 150px;">NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th class="text-center" style="width: 320px;">Status Kehadiran</th>
                            <th style="width: 250px;">Keterangan Tambahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa as $index => $m)
                        @php
                            $data_absen = $absensi->has($m->id) ? $absensi[$m->id] : null;
                            $status_sekarang = old("absensi.{$m->id}.status", $data_absen ? $data_absen->status : 'hadir');
                            $keterangan_sekarang = old("absensi.{$m->id}.keterangan", $data_absen ? $data_absen->keterangan : '');
                        @endphp
                        <tr>
                            <td class="text-center text-muted fw-medium">{{ $index + 1 }}</td>
                            <td class="fw-bold text-dark">{{ $m->nim }}</td>
                            <td class="fw-semibold">{{ $m->nama }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="absensi[{{ $m->id }}][status]" id="h_{{ $m->id }}" value="hadir" {{ $status_sekarang == 'hadir' ? 'checked' : '' }} required>
                                        <label class="form-check-label small fw-bold text-success" for="h_{{ $m->id }}">Hadir</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="absensi[{{ $m->id }}][status]" id="i_{{ $m->id }}" value="izin" {{ $status_sekarang == 'izin' ? 'checked' : '' }} required>
                                        <label class="form-check-label small fw-bold text-primary" for="i_{{ $m->id }}">Izin</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="absensi[{{ $m->id }}][status]" id="s_{{ $m->id }}" value="sakit" {{ $status_sekarang == 'sakit' ? 'checked' : '' }} required>
                                        <label class="form-check-label small fw-bold text-warning" for="s_{{ $m->id }}">Sakit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="absensi[{{ $m->id }}][status]" id="a_{{ $m->id }}" value="alpha" {{ $status_sekarang == 'alpha' ? 'checked' : '' }} required>
                                        <label class="form-check-label small fw-bold text-danger" for="a_{{ $m->id }}">Alpha</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="absensi[{{ $m->id }}][keterangan]" value="{{ $keterangan_sekarang }}" class="form-control form-control-sm" placeholder="Opsional">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer bg-white border-top py-4 text-end">
                <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">💾 Simpan Data Absensi</button>
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted mb-3">Belum ada mahasiswa yang terdaftar di kelas ini.</p>
                <a href="{{ route('kelas.mahasiswa.index', $kelas->id) }}" class="btn btn-outline-primary btn-sm px-4 fw-bold">Tambahkan Mahasiswa Terlebih Dahulu</a>
            </div>
        @endif
</form>
</div>
@endsection
