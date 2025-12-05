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
        Schema::create('produk', function (Blueprint $table) {
            $table->integer ('id')->primary();
            $table->string ('nama')->nullable();
            $table->integer ('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('kategori_produk')->onDelete('cascade');
            $table->string ('nama_kategori');
            $table->foreign('nama_kategori')->references('nama_kategori')->on('kategori_produk')->onDelete('cascade');
            $table->string ('jenis')->nullable();
            $table->integer ('stok')->nullable();
            $table->decimal ('harga',8,2)->nullable();
            $table->integer ('dosis')->nullable();
            $table->date ('tanggal_kadaluarsa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
