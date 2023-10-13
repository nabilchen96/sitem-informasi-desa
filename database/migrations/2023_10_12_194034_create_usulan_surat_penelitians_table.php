<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulanSuratPenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_surat_penelitians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usulan_proposal_id'); //FK
            $table->string('file_proposal')->nullable();
            $table->enum('status',['0','1','2']);
            $table->string('token_akses')->nullable(); //FK
            $table->date('tgl_uplaod')->nullable();
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
        Schema::dropIfExists('usulan_surat_penelitians');
    }
}
