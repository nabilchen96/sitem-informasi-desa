<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahun_akademik_id'); //FK
            $table->string('nama_kegiatan');
            $table->string('tahun')->nullable();
            $table->enum('status',['0','1']);
            $table->enum('jenis_kegiatan',['Hibah Penelitian','Pengabdian Masyarakat']);
            $table->timestamps();

            $table->foreign('tahun_akademik_id')->references('id')->on('tahun_akademiks')
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
        Schema::dropIfExists('kegiatans');
    }
}
