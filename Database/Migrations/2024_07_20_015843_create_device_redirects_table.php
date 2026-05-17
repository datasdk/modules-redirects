<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceRedirectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(!Schema::hasTable("device_redirects")){

            Schema::create('device_redirects', function (Blueprint $table) {
                $table->id();
                $table->string('name',100);
                $table->string('platform'); // e.g., 'ios', 'android'
                $table->string('url');      // The redirect URL
                $table->timestamps();
            });

        }
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        
        if(Schema::hasTable("device_redirects")){
            Schema::dropIfExists('device_redirects'); 
        }
        
    }
}
