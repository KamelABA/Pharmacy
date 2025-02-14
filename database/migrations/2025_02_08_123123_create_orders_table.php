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
    if (!Schema::hasTable('orders')) { // ✅ التأكد من عدم وجود الجدول مسبقًا
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->string('state');
            $table->string('city');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('قيد المعالجة');
            $table->timestamps();
        });
    }
}

public function down()
{
    Schema::dropIfExists('orders'); // ✅ حذف الجدول إذا كان موجودًا عند التراجع
}



};
