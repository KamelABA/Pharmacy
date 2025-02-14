<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) { 
            $table->string('type', 500)->change();  // Increase length to 500 if needed
        
        });
    }
    
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('type', 255)->change(); 
        });
    }

};
