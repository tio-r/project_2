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
        Schema::create('rating', function (Blueprint $table) {
            $table->integer ('id_rating')->primary();
            $table->integer ('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->string ('nama');
            $table->foreign('nama')->references('nama')->on('user')->onDelete('cascade');
            $table->integer ('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('kategori_produk')->onDelete('cascade');
            $table->integer('bintang')->nullable();
            $table->text('ulasan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('rating');
    }
};
