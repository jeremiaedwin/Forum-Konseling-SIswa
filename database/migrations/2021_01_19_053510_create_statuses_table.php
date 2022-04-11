<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
        });

        /**
         *  DB::table('statuses')->insert([
            ['id'=>'0', 'status'=>'Active', 'created_at'=>date('Y-m-d H:i:s')],
            ['id'=>'1', 'status'=>'Non-Active', 'created_at'=>date('Y-m-d H:i:s')],
        ]);

        **/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
