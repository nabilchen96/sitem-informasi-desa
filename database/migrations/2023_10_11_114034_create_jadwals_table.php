<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kegiatan_id'); //FK
            $table->string('nama_jadwal');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->enum('tahapan',['Pengusulan','Pelaksanaan','Penyelesaian']);
            $table->enum('status',['0','1']);
            $table->timestamps();

            $table->foreign('kegiatan_id')->references('id')->on('kegiatans')
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
        Schema::dropIfExists('jadwals');
    }
}
