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
        Schema::create('progress', function (Blueprint $table) {
            $table->string('id_progres')->primary();
            $table->string('id_unit');
            $table->foreignId('id_pengawas')->nullable()->constrained('users')->nullOnDelete();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->date('tanggal');
            $table->enum('status', ['mulai', 'proses', 'selesai'])->default('mulai');
            $table->enum('jenis', ['pembangunan', 'perbaikan'])->default('pembangunan');
            $table->timestamps();

            $table->foreign('id_unit')->references('id_unit')->on('unit_rumahs')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
