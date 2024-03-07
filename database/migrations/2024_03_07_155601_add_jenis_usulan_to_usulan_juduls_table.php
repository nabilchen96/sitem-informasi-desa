<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisUsulanToUsulanJudulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usulan_juduls', function (Blueprint $table) {
            $table->enum('jenis_usulan',['Penelitian','PKM'])->after('sub_topik')->default('Penelitian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usulan_juduls', function (Blueprint $table) {
            //
        });
    }
}
