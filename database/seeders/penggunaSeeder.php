<?php

namespace Database\Seeders;

use App\Models\penggunalogin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class penggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penggunaData = [
            [
                'keamanan' => 'GP7654login',
                'role' => 'Guru Piket'
            ],
            [
                'keamanan' => 'kesiswaan73645',
                'role' => 'Guru Piket'
            ],
        ];

        foreach($penggunaData as $data => $val) {
            penggunalogin::create($val);
        }
    }
}
