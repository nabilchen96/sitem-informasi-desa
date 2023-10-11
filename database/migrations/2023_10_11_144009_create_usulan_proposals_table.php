<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulanProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usulan_judul_id'); //FK
            $table->string('file_proposal')->nullable();
            $table->string('file_rab')->nullable();
            $table->string('link_video')->nullable();
            $table->text('anggota')->nullable();
            $table->enum('status',['0','1','2']);
            $table->unsignedBigInteger('token_akses'); //FK
            $table->date('tanggal_upload')->nullable();
            $table->timestamps();

            $table->foreign('usulan_judul_id')->references('id')->on('usulan_juduls')
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
        Schema::dropIfExists('usulan_proposals');
    }
}
