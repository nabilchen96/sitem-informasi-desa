<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSudahDinilaiToUsulanProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usulan_proposals', function (Blueprint $table) {
            $table->enum('sudah_dinilai',['0','1'])->after('reviewer2_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usulan_proposals', function (Blueprint $table) {
            //
        });
    }
}
