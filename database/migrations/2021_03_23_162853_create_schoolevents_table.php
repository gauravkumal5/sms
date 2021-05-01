<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchooleventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoolevents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('eventType');
            $table->date('startEventDate');
            $table->date('endEventDate');
            $table->text('eventDescription')->nullable();
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
        Schema::dropIfExists('schoolevents');
    }
}