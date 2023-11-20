<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeminarAntarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminar_antaras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usulan_judul_id'); //FK
            $table->foreign('usulan_judul_id')->references('id')->on('usulan_juduls')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string('file_seminar_antara')->nullable();
            $table->string('token_akses');
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
        Schema::dropIfExists('seminar_antaras');
    }
}
