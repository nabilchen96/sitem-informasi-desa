<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usulan_proposal_id'); //FK
            $table->string('biaya_diusulkan')->nullable();
            $table->string('biaya_direkomendasikan')->nullable();
            $table->integer('nilai_kriteria_1')->nullable();
            $table->integer('nilai_kriteria_2')->nullable();
            $table->integer('nilai_kriteria_3')->nullable();
            $table->integer('nilai_kriteria_4')->nullable();
            $table->integer('nilai_kriteria_5')->nullable();
            $table->integer('nilai_kriteria_6')->nullable();
            $table->text('saran_perbaikan')->nullable();
            $table->text('alasan_bagi_yang_tidak_diterima')->nullable();
            $table->string('hari')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('bulan')->nullable();
            $table->year('tahun')->nullable();
            $table->enum('rekomendasi',['Diterma','Tidak Diterima'])->nullable();
            $table->timestamps();

            $table->foreign('usulan_proposal_id')->references('id')->on('usulan_proposals')
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
        Schema::dropIfExists('penilaian_proposals');
    }
}
