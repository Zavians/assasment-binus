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
        Schema::create('ujian', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('mata_kuliah_id')->references('id')->on('mata_kuliah')->onDelete('cascade');
            $table->integer('durasi_ujian'); 
            $table->dateTime('tanggal_ujian')->nullable();  
            $table->timestamps();  
          
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujian');
    }
};
