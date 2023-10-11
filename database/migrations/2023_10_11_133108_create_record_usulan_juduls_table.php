<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordUsulanJudulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_usulan_juduls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usulan_judul_id'); //FK
            $table->text('keterangan_respon')->nullable();
            $table->text('judul_lama')->nullable();
            $table->string('status_record')->nullable();
            $table->date('tgl_record')->nullable();
            $table->enum('status_perubahan',['0','1','2']);
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
        Schema::dropIfExists('record_usulan_juduls');
    }
}
