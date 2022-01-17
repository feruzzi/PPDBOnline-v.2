<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetPendaftaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('set_kode_pendaftaran')->index()->nullable();
            $table->foreign('set_kode_pendaftaran')->references('kode_pendaftaran')->on('pendaftaran');
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
        Schema::dropIfExists('set_pendaftaran');
    }
}
