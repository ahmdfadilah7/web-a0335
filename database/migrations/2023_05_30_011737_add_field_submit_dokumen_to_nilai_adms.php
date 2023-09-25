<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldSubmitDokumenToNilaiAdms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai_adms', function (Blueprint $table) {
            $table->enum('submit_dokumen_1', ['ya', 'tidak'])->after('status');
            $table->enum('schedule_1', ['ya', 'tidak'])->after('submit_dokumen_1');
            $table->enum('ulang_1', ['ya', 'tidak'])->after('schedule_1');
            $table->enum('submit_dokumen_2', ['ya', 'tidak'])->after('ulang_1');
            $table->enum('schedule_2', ['ya', 'tidak'])->after('submit_dokumen_2');
            $table->enum('ulang_2', ['ya', 'tidak'])->after('schedule_2');
            $table->string('persentase')->after('nilai_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai_adms', function (Blueprint $table) {
            //
        });
    }
}
