<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jurusanController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\walikelasController;
use App\Http\Controllers\datapiketController;
use App\Http\Controllers\sekolahController;
use App\Http\Controllers\absensiController;
use App\Http\Controllers\tahunpelajaranController;
use App\Http\Controllers\penggunaloginController;

Route::get('/',
 function () {
    return view('login');
})->name('dashboard');

Route::get('/sipensi/dashboard',
 function () {
    return view('layout.content');
})->name('dashboard');

//jurusan route
Route::POST('/sipensi/dashboard/data-jurusan/tambah', [jurusanController::class, 'add'])->name('jurusan.add');
Route::GET('/sipensi/dashboard/data-jurusan/tampil', [jurusanController::class, 'index'])->name('jurusan.index');
Route::GET('/sipensi/dashboard/data-jurusan/hapus/{id}', [jurusanController::class, 'hapus'])->name('jurusan.hapus');
Route::GET('/sipensi/dashboard/data-jurusan/edit/{id}', [jurusanController::class, 'edit'])->name('jurusan.edit');
Route::PUT('/sipensi/dashboard/data-jurusan/update-data/{id}', [jurusanController::class, 'update'])->name('jurusan.update');


//wali-kelas route
Route::POST('/sipensi/dashboard/data-wali-kelas/tambah', [walikelasController::class, 'add'])->name('walikelas.add');
Route::GET('/sipensi/dashboard/data-wali-kelas/tampil', [walikelasController::class, 'index'])->name('walikelas.index');
Route::GET('/sipensi/dashboard/data-wali-kelas/hapus/{id}', [walikelasController::class, 'hapus'])->name('walikelas.hapus');
Route::GET('/sipensi/dashboard/data-wali-kelas/edit/{id}', [walikelasController::class, 'edit'])->name('walikelas.edit');
Route::PUT('/sipensi/dashboard/data-wali-kelas/update-data/{id}', [walikelasController::class, 'update'])->name('walikelas.update');

//data-guru-piket route
Route::POST('/sipensi/dashboard/data-guru-piket/tambah', [datapiketController::class, 'add'])->name('datapiket.add');
Route::GET('/sipensi/dashboard/data-guru-piket/tampil', [datapiketController::class, 'index'])->name('datapiket.index');
Route::GET('/sipensi/dashboard/data-guru-piket/hapus/{hari_piket}', [datapiketController::class, 'hapus'])->name('datapiket.hapus');
Route::GET('/sipensi/dashboard/data-guru-piket/edit/{hari_piket}', [datapiketController::class, 'edit'])->name('datapiket.edit');
Route::PUT('/sipensi/dashboard/data-guru-piket/update-data/{hari_piket}', [datapiketController::class, 'update'])->name('datapiket.update');


//data-sekolah route
Route::GET('/sipensi/dashboard/data-sekolah/tampil', [sekolahController::class, 'index'])->name('sekolah.index');
Route::POST('/sipensi/dashboard/data-sekolah/tambah', [sekolahController::class, 'add'])->name('sekolah.add');
Route::POST('/sipensi/dashboard/data-sekolah/update-gambar-baru', [sekolahController::class, 'updateImage'])->name('datasekolah.updateImage');

//data-siswa route
Route::POST('/sipensi/dashboard/data-siswa/tambah', [studentController::class, 'add'])->name('datasiswa.add');
Route::GET('/sipensi/dashboard/data-siswa/tampil', [studentController::class, 'index'])->name('datasiswa.index');
Route::GET('/sipensi/dashboard/data-siswa/edit/{nis}', [studentController::class, 'edit'])->name('datasiswa.edit');
Route::PUT('/sipensi/dashboard/data-siswa/update/{nis}', [studentController::class, 'update'])->name('datasiswa.update');
Route::GET('/sipensi/dashboard/data-siswa/preview/{nis}', [studentController::class, 'preview'])->name('datasiswa.preview');
Route::GET('/sipensi/dashboard/data-siswa/hapus/{nis}', [studentController::class, 'hapus'])->name('datasiswa.hapus');
Route::POST('/sipensi/dashboard/data-siswa/import-data-siswa', [studentController::class, 'import'])->name('datasiswa.import');
Route::POST('/sipensi/dashboard/data-siswa/upload-foto/{nis}', [studentController::class, 'addfoto'])->name('datasiswa.addfoto');
Route::get('/sipensi/dashboard/data-siswa/export-data-siswa', [studentController::class, 'export'])->name('datasiswa.export');

//absensi-siswa route
Route::POST('/sipensi/dashboard/absensi/', [absensiController::class, 'absen'])->name('absensi.absen');
Route::GET('/sipensi/dashboard/absensi/tampil', [absensiController::class, 'index'])->name('absensi.index');
Route::GET('/sipensi/dashboard/absensi/tampil/absen-kelas/{id}', [absensiController::class, 'absenkelas'])->name('absensi.absenkelas');

//tahun-pelajaran route
Route::get('/sipensi/dashboard/data-tahun-pelajaran/tampil', [tahunpelajaranController::class, 'index'])->name('tahunpelajaran.index');
Route::post('/sipensi/dashboard/data-tahun-pelajaran/tambah', [tahunpelajaranController::class, 'add'])->name('tahunpelajaran.add');
Route::put('/sipensi/dashboard/data-tahun-pelajaran/pengaktifan/{id}', [tahunpelajaranController::class, 'toggleStatus'])->name('tahunpelajaran.toggleStatus');

//login route
Route::post('/sipensi/login', [penggunaloginController::class, 'login'])->name('login');
