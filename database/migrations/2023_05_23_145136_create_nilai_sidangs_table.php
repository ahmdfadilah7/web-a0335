<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiSidangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_sidangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuanjudul_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('prodi_id');
            $table->enum('penilai',['Penguji', 'Pembimbing']);
            $table->string('nilai_1');
            $table->string('nilai_2');
            $table->string('nilai_3');
            $table->string('nilai_4');
            $table->string('nilai_5');
            $table->string('total_nilai');
            $table->foreign('pengajuanjudul_id')->references('id')->on('pengajuanjuduls')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id')->on('prodis')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('nilai_sidangs');
    }
}
