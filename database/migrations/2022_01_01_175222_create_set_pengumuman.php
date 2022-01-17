<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetPengumuman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('set_kode_pengumuman')->index()->nullable();
            $table->foreign('set_kode_pengumuman')->references('kode_pengumuman')->on('pengumuman');
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
        Schema::dropIfExists('set_pengumuman');
    }
}
