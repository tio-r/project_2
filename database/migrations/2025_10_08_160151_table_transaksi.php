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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->integer ('id_transaksi')->primary();
            $table->integer ('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->string ('nama');
            $table->foreign('nama')->references('nama')->on('user')->onDelete('cascade');
            $table->decimal ('total_harga',8,2)->nullable();
            $table->enum ('metode_pembayaran', ['Transfer Bank', 'E-wallet', 'COD']);
            $table->enum ('status_transaksi', ['Pending', 'Sukses', 'Gagal']);
            $table->dateTime ('tanggal_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
