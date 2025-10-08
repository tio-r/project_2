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
        Schema::create('detail_keranjang', function (Blueprint $table) {
            $table->integer ('id_detail')->primary();
            $table->integer ('id_keranjang');
            $table->foreign('id_keranjang')->references('id_keranjang')->on('keranjang')->onDelete('cascade');
            $table->integer ('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('kategori_produk')->onDelete('cascade');
            $table->string ('pesanan')->nullable();
            $table->decimal ('subtotal',8,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_keranjang');
    }
};
