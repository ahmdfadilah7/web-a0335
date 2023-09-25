<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanjudulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuanjuduls', function (Blueprint $table) {
            $table->id();
            $table->integer('mahasiswa_id');
            $table->integer('dosen_id');
            $table->string('judul');
            $table->string('keterangan');
            $table->enum('status', [0,1,2])->comment('0 Proses, 1 Diterima, 2 Ditolak');
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
        Schema::dropIfExists('pengajuanjuduls');
    }
}
