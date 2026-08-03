<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('form_permintaan_perubahans', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->nullable()->after('nama_pemohon');
        });
    }

    public function down()
    {
        Schema::table('form_permintaan_perubahans', function (Blueprint $table) {
            $table->dropColumn('unit_id');
        });
    }
};
