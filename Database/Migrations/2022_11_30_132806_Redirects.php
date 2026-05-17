<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Redirects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        if(!Schema::hasTable("redirects"))
        Schema::create('redirects', function (Blueprint $table) {


            $table->increments('id');
            $table->string('name',100);
            $table->string('url',200)->nullable();
            $table->boolean('active')->default(1);
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
  
        if(Schema::hasTable("redirects"))
        Schema::dropIfExists('redirects');

    }
}
