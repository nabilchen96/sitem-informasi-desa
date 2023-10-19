<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReviewerToUsulanProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usulan_proposals', function (Blueprint $table) {
            $table->unsignedBigInteger('reviewer1_id')->after('token_akses')->nullable(); //FK
            $table->unsignedBigInteger('reviewer2_id')->after('reviewer1_id')->nullable(); //FK

            $table->foreign('reviewer1_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('reviewer2_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
