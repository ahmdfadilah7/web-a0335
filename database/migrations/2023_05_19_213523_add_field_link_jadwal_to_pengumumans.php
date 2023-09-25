<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldLinkJadwalToPengumumans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengumumans', function (Blueprint $table) {
            $table->text('link_jadwal')->nullable()->after('title');
            $table->text('file_jadwal')->nullable()->after('link_jadwal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengumumans', function (Blueprint $table) {
            //
        });
    }
}
