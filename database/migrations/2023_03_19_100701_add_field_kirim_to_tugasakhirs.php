<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldKirimToTugasakhirs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tugasakhirs', function (Blueprint $table) {
            $table->enum('kirim', [0,1])->comment('0 Belum dikirim, 1 Terkirim')->after('status');
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
