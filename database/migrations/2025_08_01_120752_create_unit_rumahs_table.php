<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unit_rumahs', function (Blueprint $table) {
            $table->string('id_unit')->primary(); // string primary key
            $table->string('no_rumah');
            $table->string('type');
            $table->string('alamat');
            $table->string('id_penghuni')->nullable();
            $table->enum('status', ['Selesai Pembangunan', 'Dalam Proses', 'Belum Dibangun'])->default('Dalam Proses');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_rumahs');
    }
};
