<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisiProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisi_proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_id'); //FK
            $table->string('file_proposal_revisi')->nullable();
            $table->enum('status',['0','1','2']);
            $table->string('token_akses')->nullable(); //FK
            $table->date('tgl_upload')->nullable();
            $table->timestamps();

            $table->foreign('jadwal_id')->references('id')->on('jadwals')
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
        Schema::dropIfExists('revisi_proposals');
    }
}
