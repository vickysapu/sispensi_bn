<?php
namespace App\Imports;

use App\Models\student;
use App\Models\Jurusan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Log;

class ImportDataSiswa implements ToModel, WithStartRow
{
    private function convertToRoman($number)
    {
        $map = [
            12 => 'XII',
            11 => 'XI',
            10 => 'X',
        ];

        if (isset($map[$number])) {
            return $map[$number];
        }

        if (preg_match('/^(X{0,3})(IX|IV|V?I{0,3})$/i', $number)) {
            return strtoupper($number);
        }

        return null;
    }

    private function getKodeJurusan($namaJurusan)
    {
        $jurusan = Jurusan::where('nama_jurusan', $namaJurusan)->first();
        return $jurusan ? $jurusan->kode_jurusan : null;
    }

    public function model(array $row)
    {
        Log::info('Processing row: ' . json_encode($row));

        $kelas = $this->convertToRoman($row[3]);
        $kodeJurusan = $this->getKodeJurusan($row[4]);

        Log::info('Kelas after conversion: ' . $kelas);
        Log::info('Kode Jurusan after check: ' . $kodeJurusan);

        if (!$kelas || !$kodeJurusan) {
            Log::warning('Skipping row due to invalid kelas or jurusan: ' . json_encode($row));
            return null;
        }

        Log::info('Inserting data: Nama Siswa=' . $row[0] . ', Kelas=' . $kelas . ', Kode Jurusan=' . $kodeJurusan);

        return new student([
            'nama_siswa' => $row[0],
            'nis' => $row[1],
            'nisn' => $row[2],
            'kelas' => $kelas,
            'kode_jurusan' => $kodeJurusan,
            'jenis_kelamin' => $row[5],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}