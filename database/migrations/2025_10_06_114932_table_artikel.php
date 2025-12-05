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
        Schema::create('artikel', function (Blueprint $table) {
            $table->integer ('id_artikel')->primary();
            $table->string ('judul')->nullable();
            $table->string ('konten')->nullable();
            $table->dateTime('tanggal_posting');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }};
