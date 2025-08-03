<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Pengawas',
            'email' => 'pengawas@example.com',
            'password' => Hash::make('password'),
            'role' => 'pengawas',
        ]);

        User::create([
            'name' => 'Pengawas 2',
            'email' => 'pengawas2@example.com',
            'password' => Hash::make('password'),
            'role' => 'pengawas',
        ]);
    }
}
