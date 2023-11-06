<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKolomsToPenilaianProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penilaian_proposals', function (Blueprint $table) {
            $table->integer('n1_x_bobot')->after('nilai_kriteria_1')->nullable();
            $table->integer('n2_x_bobot')->after('nilai_kriteria_2')->nullable();
            $table->integer('n3_x_bobot')->after('nilai_kriteria_3')->nullable();
            $table->integer('n4_x_bobot')->after('nilai_kriteria_4')->nullable();
            $table->integer('n5_x_bobot')->after('nilai_kriteria_5')->nullable();
            $table->integer('n6_x_bobot')->after('nilai_kriteria_6')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilaian_proposals', function (Blueprint $table) {
            //
        });
    }
}
