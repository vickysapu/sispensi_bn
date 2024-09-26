<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sekolah;
use Illuminate\Support\Facades\File;

class sekolahController extends Controller
{
    public function index() {
        $indexSekolah = sekolah::all();

        return view("admin.guruPiket.datasekolah", compact('indexSekolah'));
    }
    public function add(Request $request) {
        $addsekolah = sekolah::find(1);

        $addsekolah->nama_sekolah = $request->input('nama_sekolah');
        $addsekolah->telepon_sekolah = $request->input('telepon_sekolah');
        $addsekolah->email_sekolah = $request->input('email_sekolah');
        $addsekolah->website_sekolah = $request->input('website_sekolah');
        $addsekolah->alamat_sekolah = $request->input('alamat_sekolah');
        $addsekolah->kode_pos = $request->input('kode_pos');
        $addsekolah->kepala_sekolah = $request->input('kepala_sekolah');
        $addsekolah->nip_kepala_sekolah = $request->input('nip_kepala_sekolah');

        $addsekolah->save();

        return redirect()->route('sekolah.index');
    }
    public function updateImage(Request $request) {
        $updateLogo = sekolah::find(1);

        if ($request->hasFile('logo_sekolah')) {
            $image = $request->file('logo_sekolah');
            $fileName = $image->getClientOriginalName();

            $oldImage = public_path('logo/' . $updateLogo->logo_sekolah);
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }

            $image->move(public_path('logo'), $fileName);
            $updateLogo->logo_sekolah = $fileName;
        }

        $updateLogo->save();

        return redirect()->route('sekolah.index');
    }

}