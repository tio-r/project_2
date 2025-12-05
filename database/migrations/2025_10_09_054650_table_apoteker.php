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
        Schema::create('apoteker', function (Blueprint $table) {
            $table->integer ('id_apoteker')->primary();
            $table->string ('nama')->unique();
            $table->string ('email')->unique();
            $table->string ('password');
            $table->integer ('nomor_hp');
            $table->timestamp ('tanggal_daftar');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('apoteker');
    }
};
