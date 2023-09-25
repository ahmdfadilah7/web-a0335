<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiAdmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_adms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuanjudul_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('koordinator_id');
            $table->unsignedBigInteger('prodi_id');
            $table->enum('status',['TA 1', 'TA 2']);
            $table->string('nilai_1')->comment('sempro/prasidang');
            $table->string('nilai_2')->comment('seminar/sidang');
            $table->string('total_nilai');
            $table->foreign('pengajuanjudul_id')->references('id')->on('pengajuanjuduls')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id')->on('prodis')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('koordinator_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_adms');
    }
}
