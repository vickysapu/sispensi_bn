<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penggunalogin;
use App\Models\walikelas;
use Illuminate\Support\Facades\Auth;

class penggunaloginController extends Controller
{
    public function login(Request $request)
    {
        $keamanan = $request->input('keamanan');
    
        // Menggunakan model Penggunalogin yang benar
        $datapengguna = penggunalogin::where('keamanan', $keamanan)->first(); // Ganti di sini
    
        // Ambil data walikelas
        $datawalikelas = walikelas::all();
    
        $datakeamanan = $keamanan . '19131121418';
        $user = walikelas::where('kode_walikelas', $datakeamanan)->first();
    
        if ($datapengguna) {
            session(['user_id' => $datapengguna->id, 'keamanan' => $keamanan]);
            return view('layout.content', compact('datawalikelas', 'user', 'datakeamanan'));
        } else {
            return redirect()->back()->with('error', 'Kode keamanan salah.');
        }
       
    }
    
    

    public function logout()
    {
        session()->forget(['user_id', 'keamanan']);
        return redirect()->route('login');
    }
}
