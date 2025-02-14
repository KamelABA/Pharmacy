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
        // Increase size for 'name' and 'type'
        $table->string('name', 500)->change();
        $table->string('type', 500)->change();

        // Change 'description' to text (unlimited length)
        $table->text('description')->change();
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        // Revert back to original size
        $table->string('name', 255)->change();
        $table->string('type', 255)->change();

        // Revert 'description' back to string(255)
        $table->string('description', 255)->change();
    });
}


    
    
    
};
