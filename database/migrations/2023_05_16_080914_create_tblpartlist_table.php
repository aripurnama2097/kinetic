<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblpartlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblpartlist', function (Blueprint $table) {
            $table->id();
            $table->string('custcode'); 
            $table->string('dest');
            $table->string('model'); 
            $table->string('prodno');
            $table->date('jkeipodate ');
            $table->date('vandate'); 
            $table->integer('orderitem');
            $table->string('custpo'); 
            $table->string('partno');
            $table->string('partname');
            $table->integer('demand');
            $table->integer('stdpack');
            $table->string('mcshelfno');
            $table->string('vendor');
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
        Schema::dropIfExists('tblpartlist');
    }
}
