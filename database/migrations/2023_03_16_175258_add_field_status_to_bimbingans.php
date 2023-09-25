<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldStatusToBimbingans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bimbingans', function (Blueprint $table) {
            $table->enum('status', [0,1,2])->comment('0 Proses, 1 Diterima, 2 Ditolak')->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bimbingans', function (Blueprint $table) {
            //
        });
    }
}
