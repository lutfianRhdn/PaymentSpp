<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetAllForignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classes',function(Blueprint $table){
            $table->foreign('major_id')->references('id')->on('majors');
        });
        Schema::table('payments',function(Blueprint $table){
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('guard_id')->references('id')->on('guards')->onDelete('cascade');
            $table->foreign('tuition_id')->references('id')->on('tuitions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
