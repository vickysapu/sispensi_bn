<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class walikelas extends Model
{
    use HasFactory;
    protected $fillable = ['nama_walikelas', 'kelas', 'kode_jurusan', 'kode_walikelas'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan', 'kode_jurusan');
    }
    public function students()
    {
        return $this->hasMany(student::class, 'kode_jurusan', 'kode_jurusan')->where('kelas', $this->kelas);
    }
}