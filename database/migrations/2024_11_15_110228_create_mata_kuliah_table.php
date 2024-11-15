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
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->uuid('id')->primary();  // UUID sebagai primary key
            $table->string('name')->nullable();  // Nama mata kuliah
            $table->string('nama_dosen')->nullable();  // Nama dosen pengampu
            $table->integer('jumlah_sks')->nullable();  // Jumlah SKS
            $table->text('deskripsi')->nullable();  // Deskripsi mata kuliah, opsional
            $table->timestamps();  // Timestamps untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};
