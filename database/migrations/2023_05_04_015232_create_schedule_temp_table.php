<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_temp', function (Blueprint $table) {
            $table->id();
            $table->string('typedata');
            $table->string('custcode'); 
            $table->string('dest');
            $table->string('attention'); 
            $table->string('model'); 
            $table->string('prodno');
            $table->integer('lotqty');
            $table->date('jkeipodate ');
            $table->date('vandate'); 
            $table->date('etd ');
            $table->date('eta '); 
            $table->string('shipvia'); 
            $table->integer('orderitem');
            $table->string('custpo'); 
            $table->string('partno');
            $table->string('partname');
            $table->string('shelfno');
            $table->integer('demand');
            $table->string('input_user');
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
        Schema::dropIfExists('schedule_temp');
    }
}
