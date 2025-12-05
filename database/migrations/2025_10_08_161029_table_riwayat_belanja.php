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
        Schema::create('riwayat', function (Blueprint $table) {
            $table->integer ('id_riwayat')->primary();
            $table->integer ('id_transaksi');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onDelete('cascade');
            $table->enum ('status_pengiriman', ['Dikirim', 'Sukses'])->default('Dikirim');
            $table->string ('no_resi')->nullable();
            $table->text ('alamat_pengiriman')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat');
    }
};
