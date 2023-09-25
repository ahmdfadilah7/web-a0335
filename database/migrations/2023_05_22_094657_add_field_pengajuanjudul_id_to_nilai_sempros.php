<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldPengajuanjudulIdToNilaiSempros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai_sempros', function (Blueprint $table) {
            $table->unsignedBigInteger('pengajuanjudul_id')->after('id');
            $table->foreign('pengajuanjudul_id')->references('id')->on('pengajuanjuduls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai_sempros', function (Blueprint $table) {
            //
        });
    }
}
