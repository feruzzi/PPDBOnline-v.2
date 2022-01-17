<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('username_siswa')->index();
            $table->string('id_pendaftaran')->unique();
            $table->string('nisn');
            $table->string('nama_siswa');
            $table->string('j_kelamin');
            $table->string('t_lahir');
            $table->date('tgl_lahir');
            $table->string('agama');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('asal_sekolah');
            $table->string('nama_sekolah');
            $table->string('nama_ayah');
            $table->string('hp_ayah');
            $table->string('pendidikan_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah');
            $table->string('nama_ibu');
            $table->string('hp_ibu');
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('penghasilan_ibu');
            $table->float('nilai_bindo');
            $table->float('nilai_matematika');
            $table->float('nilai_ipa');
            $table->float('rapot_bindo');
            $table->float('rapot_matematika');
            $table->float('rapot_ipa');
            $table->float('rapot_bing');
            $table->float('total_nilai_berkas')->default('0');
            $table->string('pilihan_1');
            $table->string('pilihan_2');
            $table->string('foto');
            $table->string('jalur')->index();
            $table->string('status_seleksi');
            $table->string('username_admin')->index()->nullable();
            $table->foreign('username_siswa')->references('username')->on('users')->restrictOnDelete()->restrictOnUpdate();
            $table->foreign('username_admin')->references('username')->on('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('jalur')->references('kode_pendaftaran')->on('pendaftaran')->restrictOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('siswa');
    }
}
