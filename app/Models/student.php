<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['nis', 'nama_siswa', 'nisn', 'kelas', 'kode_jurusan', 'jenis_kelamin','foto_pelajar'];
    protected $primaryKey = 'nis';

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan', 'kode_jurusan');
    }
}