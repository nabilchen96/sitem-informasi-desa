<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordUsulanProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_usulan_proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usulan_proposal_id'); //FK
            $table->text('keterangan_respon')->nullable();
            $table->string('status_record')->nullable();
            $table->string('file_proposal_lama')->nullable();
            $table->string('file_rab_lama')->nullable();
            $table->date('tgl_record')->nullable();
            $table->enum('status_perubahan',['0','1','2']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record_usulan_proposals');
    }
}
