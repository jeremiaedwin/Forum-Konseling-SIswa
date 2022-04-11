<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportposts', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id');
            $table->integer('receiver_id');
            $table->text('klasifikiasi_masalah');
            $table->text('deskripsi_report');
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
        Schema::dropIfExists('reportposts');
    }
}
