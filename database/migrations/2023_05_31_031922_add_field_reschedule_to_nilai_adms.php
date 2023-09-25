<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldRescheduleToNilaiAdms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai_adms', function (Blueprint $table) {
            $table->enum('reschedule_1', ['ya', 'tidak'])->after('schedule_1');
            $table->enum('reschedule_2', ['ya', 'tidak'])->after('schedule_2');
            $table->string('persentase_2')->after('persentase');
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
