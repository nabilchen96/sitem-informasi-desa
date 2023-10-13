<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisiDokumenLuaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisi_dokumen_luarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokumen_luaran_id'); //FK
            $table->string('file_dokumen_luaran_revisi')->nullable();
            $table->string('file_dokumen_luaran_lama')->nullable();
            $table->enum('status',['0','1','2']);
            $table->string('token_akses')->nullable(); //FK
            $table->date('tgl_upload')->nullable();
            $table->timestamps();

            $table->foreign('dokumen_luaran_id')->references('id')->on('dokumen_luarans')
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
        Schema::dropIfExists('revisi_dokumen_luarans');
    }
}
