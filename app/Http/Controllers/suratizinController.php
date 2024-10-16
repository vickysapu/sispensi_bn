<?php

namespace App\Http\Controllers;

use App\Models\sekolah;
use App\Models\suratizin;
use App\Models\student;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class suratizinController extends Controller
{
    public function index() {
        $datasiswa = student::all();
        $sekolah = sekolah::first();

        return view("admin.guruPiket.suratizin", compact("datasiswa", "sekolah"));
    }
    public function cetak(Request $request)
    {
        function generateUUID() {
            return Uuid::uuid4()->toString();
        }

        $addsuratizin = new suratizin();

        $student = student::where('nis', $request->input('nis'))->first();

        if ($student) {
            $uuid = generateUUID();

        $nama_siswa = explode(',', $student->nis);

        foreach ($nama_siswa as $siswa) {
            $siswa =trim($siswa);
            
            $addsuratizin->nomor = $request->input("nomor");
            $addsuratizin->perihal = $request->input("perihal");
            $addsuratizin->nis = $nama_siswa;
            $addsuratizin->uuid = $uuid;
            $addsuratizin->jam_pelajaran = $request->input("jam_pelajaran");
            $addsuratizin->keterangan = $request->input("keterangan");
            $addsuratizin->save();

            $studentsWithSameUUID = student::whereHas('suratizin', function($query) use ($uuid) {
                $query->where('uuid', $uuid);
            })->get();
        }

            $sekolah = sekolah::first();

            return view('admin.guruPiket.desainsurat', compact('addsuratizin', 'sekolah', 'studentsWithSameUUID'))
                ->with('print', true);
        } else {
            return redirect()->back()->with('error', 'Nama siswa tidak ditemukan.');
        }
    }

}
