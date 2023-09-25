<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotakelompoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotakelompoks', function (Blueprint $table) {
            $table->id();
            $table->integer('kelompok_id');
            $table->integer('user_id');
            $table->enum('status', [0,1])->default(1)->comment('0 Tidak Aktif, 1 Aktif');
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
        Schema::dropIfExists('anggotakelompoks');
    }
}
