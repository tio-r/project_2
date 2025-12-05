<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsers extends Migration
{
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string('nama')->after('id_user');
            $table->string('nomor_hp')->after('email');
        });
    }

    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn(['nama', 'nomor_hp']);
        });
    }
}