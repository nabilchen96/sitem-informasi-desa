<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeminarHasilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminar_hasils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usulan_judul_id'); //FK
            $table->foreign('usulan_judul_id')->references('id')->on('usulan_juduls')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string('token_akses');

            $table->string('file_seminar_hasil')->nullable();
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
        Schema::dropIfExists('seminar_hasils');
    }
}
