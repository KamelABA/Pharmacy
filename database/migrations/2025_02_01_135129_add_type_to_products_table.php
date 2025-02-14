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
        $table->string('type', 255)->nullable();  // Add 'type' column with a string type
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('type');  // Drop the 'type' column if rolling back
    });
}

    
};
