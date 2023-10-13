<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenLuaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_luarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_id'); //FK
            $table->string('file_laporan_akhir')->nullable();
            $table->enum('status',['0','1','2']);
            $table->string('token_akses')->nullable(); //FK
            $table->string('file_artikel_loa')->nullable();
            $table->string('file_haki')->nullable();
            $table->string('link_artikel')->nullable();
            $table->string('bukti_produk')->nullable();
            $table->date('tgl_upload')->nullable();
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
        Schema::dropIfExists('dokumen_luarans');
    }
}
