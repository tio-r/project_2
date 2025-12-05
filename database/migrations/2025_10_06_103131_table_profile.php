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
        Schema::create('profile', function (Blueprint $table) {
            $table->integer ('id_profile')->primary();
            $table->string ('foto_profile')->nullable();
            $table->integer ('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->string ('nama');
            $table->foreign('nama')->references('nama')->on('user')->onDelete('cascade');
            $table->string ('usia')->nullable();
            $table->enum ('jenis_kelamin', ['Laki-Laki', 'Perempuan', '?'])->default('?');
            $table->enum ('notifikasi' , ['aktif', 'nonaktif'])->default('aktif');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
