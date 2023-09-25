<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldStatusToDokumenpengujis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokumenpengujis', function (Blueprint $table) {
            $table->enum('status', [1])->comment('1 Terkirim')->default(1)->after('tugasakhir_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dokumenpengujis', function (Blueprint $table) {
            //
        });
    }
}
