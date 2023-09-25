<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldKelompokIdToTugasakhirs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tugasakhirs', function (Blueprint $table) {
            $table->integer('kelompok_id')->after('user_id');
            $table->enum('status', [0,1])->comment('0 Artefak, 1 Aktif')->after('kelompok_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tugasakhirs', function (Blueprint $table) {
            //
        });
    }
}
