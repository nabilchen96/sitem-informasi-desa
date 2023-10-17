<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratIzinPenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_izin_penelitians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dosen');
            $table->text('alasan_pengajuan_surat');
            $table->date('tanggal_rencana_kegiatan');
            $table->string('lokasi_rencana_kegiatan');
            $table->string('judul_penelitian_terkait');
            $table->string('file_surat_izin_penelitian')->nullable();
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
        Schema::dropIfExists('surat_izin_penelitians');
    }
}
