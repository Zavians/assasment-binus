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
        Schema::create('penugasan_pic_mata_kuliah', function (Blueprint $table) {
            $table->uuid('id')->primary();  
            $table->dateTime('deadline')->nullable();  
            $table->string('status', 50)->default('pending');  
            $table->foreignUuid('pic_user_id')->references('id')->on('pic_user')->onDelete('cascade');
            $table->foreignUuid('mata_kuliah_id')->references('id')->on('mata_kuliah')->onDelete('cascade');
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penugasan_pic_mata_kuliah');
    }
};
