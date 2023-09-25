<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldPengajuanjudulIdToNilaiSeminars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai_seminars', function (Blueprint $table) {
            $table->unsignedBigInteger('prodi_id')->after('dosen_id');
            $table->unsignedBigInteger('pengajuanjudul_id')->after('id');
            $table->foreign('pengajuanjudul_id')->references('id')->on('pengajuanjuduls')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id')->on('prodis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai_seminars', function (Blueprint $table) {
            //
        });
    }
}
