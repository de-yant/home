<?php

namespace Database\Seeders;

use App\Models\UnitRumah;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //     User::create([
    //     'name' => 'Admin',
    //     'email' => 'admin@example.com',
    //     'password' => Hash::make('password'),
    //     'role' => 'admin',
    // ]);
        //['id_unit', 'no_rumah', 'type', 'alamat', 'id_penghuni'];

    UnitRumah::create([
        'id_unit' => 'UNIT-0001',
        'no_rumah' => '001',
        'type' => 'Tipe A',
        'alamat' => 'Jl. Contoh No. 1',
        'id_penghuni' => 1,
    ]);

    UnitRumah::create([
        'id_unit' => 'UNIT-0002',
        'no_rumah' => '002',
        'type' => 'Tipe B',
        'alamat' => 'Jl. Contoh No. 2',
        'id_penghuni' => 2,
    ]);
    }
}

    /**
     * Additional context: This seeder is used to populate the database with initial unit data.
     * It creates two example units with predefined attributes.
     */

