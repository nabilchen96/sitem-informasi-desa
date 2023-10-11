<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulanJudulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_juduls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_id'); //FK
            $table->string('nama_ketua');
            $table->text('judul_penelitian');
            $table->enum('jenis_pelaksanaan',['Mandiri','Kelompok']);
            $table->string('jenis_penelitian')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('sub_topik')->nullable();
            $table->unsignedBigInteger('token_akses'); //FK
            $table->enum('status',['0','1','2']);
            $table->date('tanggal_upload')->nullable();
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
        Schema::dropIfExists('usulan_juduls');
    }
}
