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
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->nullable(); // المستخدم الذي كتب التعليق (إن وجد)
        $table->text('comment'); // نص التعليق
        $table->timestamps();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    });
}

};
