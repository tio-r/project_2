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
        Schema::create('chat', function (Blueprint $table) {
            $table->integer ('id_chat')->primary();
            $table->integer ('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->string ('nama_user');
            $table->foreign('nama_user')->references('nama')->on('user')->onDelete('cascade');
            $table->integer ('id_apoteker');
            $table->foreign('id_apoteker')->references('id_apoteker')->on('apoteker')->onDelete('cascade');
            $table->string ('nama_apoteker');
            $table->foreign('nama_apoteker')->references('nama')->on('apoteker')->onDelete('cascade');
            $table->text('pesan');
            $table->dateTime('waktu');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('chat');
    }
};
