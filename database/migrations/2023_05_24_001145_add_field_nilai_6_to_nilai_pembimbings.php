<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldNilai6ToNilaiPembimbings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai_pembimbings', function (Blueprint $table) {
            $table->string('nilai_6')->nullable()->after('nilai_5');
            $table->string('nilai_7')->nullable()->after('nilai_6');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai_pembimbings', function (Blueprint $table) {
            //
        });
    }
}
