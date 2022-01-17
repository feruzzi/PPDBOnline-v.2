<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDetailPendaftaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pendaftaran', function (Blueprint $table) {
            $table->id();
            // $table->string('kode_detail_pendaftaran')->unique();
            $table->string('detail_kode_pendaftaran')->index();
            $table->string('detail_kode_kelas')->index()->nullable();
            $table->integer('kuota')->nullable();
            $table->foreign('detail_kode_pendaftaran')->references('kode_pendaftaran')->on('pendaftaran')->restrictOnDelete()->restrictOnUpdate();
            $table->foreign('detail_kode_kelas')->references('kode_kelas')->on('kelas')->restrictOnDelete()->restrictOnUpdate();
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
        Schema::dropIfExists('detail_pendaftaran');
    }
}
