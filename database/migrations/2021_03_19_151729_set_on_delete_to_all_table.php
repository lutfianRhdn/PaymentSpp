<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetOnDeleteToAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change();
        });
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
            $table->foreign('major_id')->references('id')->on('majors')->onDelete('cascade')->change();
        });
        Schema::table('guards', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('all', function (Blueprint $table) {
            //
        });
    }
}
