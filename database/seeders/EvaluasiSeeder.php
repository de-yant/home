<?php

namespace Database\Seeders;
use App\Models\Evaluasi;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Evaluasi::create([
            'id_evaluasi' => 'EVAL-0001',
            'id_progres' => 'PROG-0001',
            'foto' => 'evaluasi1.jpg',
            'status' => 'Belum diperiksa',
            'catatan' => 'Evaluasi awal unit rumah',
        ]);
    }
}
