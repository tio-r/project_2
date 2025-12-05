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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->integer ('id_jadwal')->primary();
            $table->integer ('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->string ('nama');
            $table->foreign('nama')->references('nama')->on('user')->onDelete('cascade');
            $table->integer ('id_obat');
            $table->foreign('id_obat')->references('id')->on('produk')->onDelete('cascade');
            $table->dateTime ('waktu_konsumsi');
            $table->integer ('dosis')->nullable();
            $table->enum ('status', ['Belum Diminum', 'Sudah Diminum'])->default('Belum Diminum');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
