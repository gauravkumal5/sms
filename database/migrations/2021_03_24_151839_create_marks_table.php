<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('report_details_id');
            $table->string('terminal');
            $table->string('subject_name');
            $table->float('theory_full');
            $table->float('prac_full')->nullable();
            $table->float('theory_marks');
            $table->float('prac_marks')->nullable();
            
            $table->timestamps();

            $table->foreign('report_details_id')->references('id')->on('report_details')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marks');
    }
}