<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\absensi;
use App\Models\walikelas;
use App\Models\student;
use App\Models\datapiket;
use Carbon\Carbon;
use App\Models\tahunpelajaran;

class absensiController extends Controller
{
    public function absenkelas($id)
    {
        $walikelas = walikelas::find($id);

        if (!$walikelas) {
            return abort(404);
        }

        $data = $walikelas->students;

        $attendanceData = [];
        foreach ($data as $student) {
            $attendanceRecords = absensi::where('nis', $student->nis)
                ->whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->get();

            foreach ($attendanceRecords as $record) {
                $day = Carbon::parse($record->tanggal)->day;
                $attendanceData[$student->nama_siswa][$day] = $record->status;
            }
        }

        $datatahunpelajaran = tahunpelajaran::where('status', 1)->get();

        return view('admin.guruPiket.absenkelas', compact('datatahunpelajaran'), [
            'walikelas' => $walikelas,
            'students' => $data,
            'attendanceData' => $attendanceData,
            'currentYear' => now()->year,
            'currentMonth' => now()->month,
            'totalDays' => now()->daysInMonth,
        ]);
    }

    public function index()
    {
        $datawalikelas = walikelas::all();
        $datapiket = datapiket::all();
        $dataSiswa = student::all();
        $currentMonth = date('m');
        $currentYear = date('Y');
        $totalDays = date('t');
        $attendanceData = [];

        foreach ($dataSiswa as $siswa) {
            $attendanceRecords = Absensi::where('nis', $siswa->nis)
                ->whereMonth('tanggal', $currentMonth)
                ->whereYear('tanggal', $currentYear)
                ->get();

            foreach ($attendanceRecords as $record) {
                $day = Carbon::parse($record->tanggal)->day;
                $attendanceData[$siswa->nama_siswa][$day] = $record->status;
            }
        }

        return view('admin.guruPiket.absensi', compact('dataSiswa', 'totalDays', 'currentMonth', 'currentYear', 'attendanceData', 'datapiket', 'datawalikelas'));
    }

    public function absen(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'status' => 'required|string|in:Hadir,Tidak Hadir,Sakit,Izin',
        ]);

        $student = student::where('nama_siswa', $request->nama_siswa)->first();

        if (!$student) {
            return back()->with('error', 'Nama siswa tidak ditemukan.');
        }

        $today = now();
        $currentHour = $today->hour;

        if ($currentHour < 6 || $currentHour > 17) {
            return back()->with('error', 'Absen hanya dapat dilakukan antara jam 06:00 dan 17:00.');
        }

        $existingAbsen = absensi::where('nis', $student->nis)
            ->where('tanggal', $today->toDateString())
            ->first();

        if ($existingAbsen) {
            return back()->with('error', 'Siswa sudah diabsen hari ini.');
        }

        absensi::create([
            'nis' => $student->nis,
            'status' => $request->status,
            'tanggal' => $today->toDateString(),
        ]);

        return redirect()
            ->route('absensi.index')
            ->with([
                'success' => 'Absensi berhasil disimpan.',
                'nama_siswa' => $student->nama_siswa,
                'nis' => $student->nis,
                'foto' => $student->foto_pelajar,
            ]);
    }
}
