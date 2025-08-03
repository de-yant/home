<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluasis', function (Blueprint $table) {
            $table->string('id_evaluasi')->primary();
            $table->string('id_progres');
            $table->string('foto')->nullable(); // Assuming you want to store a photo path
            $table->enum('status', ['sesuai', 'perlu revisi', 'belum diperiksa', 'sudah diperiksa'])->default('belum diperiksa');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_progres')->references('id_progres')->on('progress')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasis');
    }
};
