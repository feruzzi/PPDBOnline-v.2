<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBerkas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->string('id_pendaftaran_berkas')->index();
            $table->string('berkas')->nullable();
            $table->string('nama_berkas')->nullable();
            $table->float('nilai_berkas')->default('0');
            $table->foreign('id_pendaftaran_berkas')->references('id_pendaftaran')->on('siswa')->restrictOnDelete()->restrictOnUpdate();
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
        Schema::dropIfExists('berkas');
    }
}
