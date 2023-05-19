<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStdPackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('std_pack', function (Blueprint $table) {
            $table->id();
            $table->integer('NIK');
            $table->string('partnumber');
            $table->string('partname'); 
            $table->string('lenght'); 
            $table->string('width'); 
            $table->string('height'); 
            $table->string('weight'); 
            $table->string('stdPack'); 
            $table->string('vendor'); 
            $table->string('jknShelf'); 
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
        Schema::dropIfExists('std_pack');
    }
}
