@extends('layouts.app')

@section('title', 'Rekap Absensi: ' . $kelas->nama_kelas)

@section('content')
    <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;" class="no-print">
        <div>
            <a href="{{ route('kelas.index') }}" style="color: #6b7280; text-decoration: none; font-size: 0.875rem;">← Kembali
                ke Daftar Kelas</a>
            <h2 style="margin: 0.5rem 0 0 0; color: #1f2937;">Rekap Absensi: {{ $kelas->nama_kelas }}</h2>
        </div>
        <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak Rekap</button>
    </div>

    <div class="card" style="padding: 1.5rem; overflow-x: auto;">
        <h3 style="text-align: center; margin-bottom: 2rem;" class="print-only">Rekap Absensi Kelas: {{ $kelas->nama_kelas }}
        </h3>

        <table class="rekap-table">
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">No</th>
                    <th style="width: 120px; text-align: center;">NIM</th>
                    <th style="min-width: 180px;">Nama Mahasiswa</th>
                    @foreach ($pertemuan as $index => $p)
                        <th style="text-align: center; min-width: 50px;">
                            P{{ $index + 1 }}<br>
                            <span
                                style="font-size: 0.65rem; font-weight: normal;">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m') }}</span>
                        </th>
                    @endforeach
                    <th style="text-align: center; background-color: #f3f4f6; width: 60px;">%</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $idx => $m)
                    @php
                        $hadir = 0;
                        $totalPertemuan = $pertemuan->count();
                    @endphp
                    <tr>
                        <td style="text-align: center;">{{ $idx + 1 }}</td>
                        <td style="text-align: center;">{{ $m->nim }}</td>
                        <td>{{ $m->nama }}</td>
                        @foreach ($pertemuan as $p)
                            @php
                                $statusRecord = $m->absensi->where('pertemuan_id', $p->id)->first();
                                $s = $statusRecord ? strtolower($statusRecord->status) : null;
                                if ($s == 'hadir') {
                                    $hadir++;
                                }
                            @endphp
                            <td
                                class="text-center fw-bold {{ $s == 'hadir' ? 'text-success' : ($s == 'alpha' ? 'text-danger' : ($s ? 'text-warning' : 'text-muted')) }}">
                                @if ($s == 'hadir')
                                    H
                                @elseif($s == 'sakit')
                                    S
                                @elseif($s == 'izin')
                                    I
                                @elseif($s == 'alpha')
                                    A
                                @else
                                    -
                                @endif
                            </td>
                        @endforeach
                        <td style="text-align: center; background-color: #f9fafb; font-weight: bold;">
                            {{ $totalPertemuan > 0 ? round(($hadir / $totalPertemuan) * 100) : 0 }}%
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 2rem; font-size: 0.875rem; color: #374151;" class="no-print">
            <p><strong>Keterangan:</strong></p>
            <ul style="list-style: none; padding: 0; display: flex; gap: 1.5rem;">
                <li><span style="color: #10b981; font-weight: bold;">H</span>: Hadir</li>
                <li><span style="color: #f59e0b; font-weight: bold;">S</span>: Sakit</li>
                <li><span style="color: #f59e0b; font-weight: bold;">I</span>: Izin</li>
                <li><span style="color: #ef4444; font-weight: bold;">A</span>: Alpha</li>
                <li><span style="color: #d1d5db; font-weight: bold;">-</span>: Belum Absen</li>
            </ul>
        </div>
    </div>

    <style>
        /* Styling Tabel Rekap Modern */
        .rekap-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
            margin-top: 1rem;
        }

        .rekap-table th,
        .rekap-table td {
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            vertical-align: middle;
        }

        .rekap-table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            .sidebar {
                display: none !important;
            }

            .main-content {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                flex: none !important;
                overflow: visible !important;
            }

            body {
                background-color: white !important;
                display: block !important;
                overflow: visible !important;
                margin: 0;
                padding: 20px;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .card {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                width: 100% !important;
                overflow: visible !important;
            }

            .print-only {
                display: block !important;
            }

            .rekap-table {
                width: 100% !important;
                border-collapse: collapse !important;
                page-break-inside: auto;
            }

            .rekap-table tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            .rekap-table th,
            .rekap-table td {
                border: 1.5px solid #475569 !important;
                /* Garis lebih tebal dan berwarna abu gelap agar tercetak jelas */
                padding: 8px 12px !important;
            }

            .rekap-table th {
                background-color: #f1f5f9 !important;
            }
        }

        .print-only {
            display: none;
        }
    </style>
@endsection
