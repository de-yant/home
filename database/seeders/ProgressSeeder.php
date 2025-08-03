<?php

namespace Database\Seeders;

use App\Models\Progress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Progress::create([
            'id_progres' => 'PROG-0001',
            'id_unit' => 'UNIT-0001',
            'id_pengawas' => 2,
            'foto' => 'null',
            'deskripsi' => 'Pembangunan pondasi selesai.',
            'tanggal' => now()->subDays(10),
            'status' => 'selesai',
            'jenis' => 'pembangunan',
        ]);
    }
}
