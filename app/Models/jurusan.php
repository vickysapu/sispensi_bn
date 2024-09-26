<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    use HasFactory;
    protected $fillable = ['kode_jurusan', 'nama_jurusan','kepanjangan_jurusan'];

    public function students()
    {
        return $this->hasMany(Student::class, 'kode_jurusan', 'kode_jurusan');
    }
}