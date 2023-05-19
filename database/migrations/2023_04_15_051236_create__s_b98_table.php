<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSB98Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblSB98', function (Blueprint $table) {
            $table->id();
        
           $table->string('custDesc');  
           $table->string('poNo'); 
           $table->string('bpcsOrderNumbe');
           $table->string('partNumber'); 
           $table->string('partName'); 
           $table->date('reqDate');
           $table->date('jkeiPoDate');
           $table->string('demand ');
           $table->integer('outset ');
           $table->string('vandate'); 
           $table->string('etd ');
           $table->string('eta '); 
           $table->string('prodNo'); 
           $table->string('inputUser'); 
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
        Schema::dropIfExists('_s_b98');
    }
}
