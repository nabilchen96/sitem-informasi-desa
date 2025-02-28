<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desas', function (Blueprint $table) {
            $table->id();
            $table->string('desa')->nullable();
            $table->string('kepala_desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('luas_wilayah')->nullable();
            $table->string('status')->nullable(); //Desa atau Kelurahan
            $table->string('website')->nullable();
            $table->string('telepon')->nullable();
            $table->text('tentang')->nullable();
            $table->string('id_creator');
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
        Schema::dropIfExists('desas');
    }
}
