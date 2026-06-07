<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Pertemuan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalKelas = $user->kelas()->count();

        $totalMahasiswa = Mahasiswa::count();

        $kelasIds = $user->kelas()->pluck('id');
        $totalPertemuan = Pertemuan::whereIn('kelas_id', $kelasIds)->count();

        return view('dashboard', compact('totalKelas', 'totalMahasiswa', 'totalPertemuan'));
    }
}
