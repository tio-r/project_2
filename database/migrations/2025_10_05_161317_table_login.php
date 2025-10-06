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
        Schema::create('login_user', function (Blueprint $table) {
            $table->integer ('id_login')->primary();
            $table->integer('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->string('nama');
            $table->foreign('nama')->references('nama')->on('user')->onDelete('cascade');
            $table->timestamp ('waktu_login');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('login_user');
    }
};
