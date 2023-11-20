<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuaranPenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('luaran_penelitians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usulan_judul_id'); //FK
            $table->foreign('usulan_judul_id')->references('id')->on('usulan_juduls')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string('file_luaran')->nullable();
            $table->string('token_akses');

            $table->string('jenis_publikasi');
            $table->string('kategori');
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
        Schema::dropIfExists('luaran_penelitians');
    }
}
