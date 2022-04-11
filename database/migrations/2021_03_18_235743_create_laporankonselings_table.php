<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporankonselingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporankonselings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('reportpost_id');
            $table->date('tanggal_konseling');
            $table->integer('masalah_selesai');
            $table->text('deskripsi_penyelesain');
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
        Schema::dropIfExists('laporankonselings');
    }
}
