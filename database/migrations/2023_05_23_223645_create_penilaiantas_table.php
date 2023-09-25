<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiantasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaiantas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuanjudul_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('prodi_id');
            $table->enum('status',['TA 1', 'TA 2']);
            $table->string('nilai_1')->comment('NSempro/NPrasidang');
            $table->string('nilai_2')->comment('NSeminar/NSidang');
            $table->string('nilai_3')->comment('NPembimbing');
            $table->string('nilai_4')->comment('NAdministrasi');
            $table->string('total_nilai');
            $table->string('grade');
            $table->foreign('pengajuanjudul_id')->references('id')->on('pengajuanjuduls')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id')->on('prodis')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('penilaiantas');
    }
}
