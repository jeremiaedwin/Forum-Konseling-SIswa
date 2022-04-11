<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_lengkap')->nullable($value = true);
            $table->date('tanggal_lahir')->nullable($value = true);;
            $table->text('alamat')->nullable($value = true);
            $table->string('agama')->nullable($value = true);
            $table->string('jenis_kelamin')->nullable($value = true);
            $table->string('foto_profil')->nullable($value = true)->default('user.png');
            $table->string('foto_sampul')->nullable($value = true)->default('wallpaper.jpg');
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
        Schema::dropIfExists('profiles');
    }
}
