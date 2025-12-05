<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(): void
    {
        Schema::create('pillbox', function (Blueprint $table) {
            $table->integer ('id_pillbox')->primary();
            $table->integer ('id_jadwal');
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal')->onDelete('cascade');
            $table->integer ('waktu_aktual')->nullable();
            $table->enum ('status_pillbox', ['Terbuka', 'Tertutup'])->default('Tertutup');
            $table->enum ('notifikasi', ['ya', 'tidak']);
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('pillbox');
    }
};
