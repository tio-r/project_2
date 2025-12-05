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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->integer ('id_notifikasi')->primary();
            $table->integer ('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->string ('nama_user');
            $table->foreign('nama_user')->references('nama')->on('user')->onDelete('cascade');
            $table->string('isi');
            $table->enum ('status', ['dibaca', 'belum'])->default('belum');
            $table->dateTime ('waktu');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
