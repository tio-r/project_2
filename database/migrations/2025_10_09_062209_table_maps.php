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
        Schema::create('maps_user', function (Blueprint $table) {
            $table->integer ('id_map')->primary();
            $table->integer ('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->string ('nama_user');
            $table->foreign('nama_user')->references('nama')->on('user')->onDelete('cascade');
            $table->text('alamat')->nullable();
            $table->text('koordinat_lat')->nullable();
            $table->text('koordinat_long')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('maps_user');
    }
};
