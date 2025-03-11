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
            // التأكد من إضافة العمود إذا لم يكن موجودًا
            if (!Schema::hasColumn('products', 'type')) {
                $table->string('type', 500)->nullable();
            }
    
            // زيادة حجم 'name'
            $table->string('name', 500)->change();
    
            // تغيير 'description' إلى نص طويل
            $table->text('description')->change();
        });
    }
    
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // إرجاع القيم الأصلية
            $table->string('name', 255)->change();
            
            // لا تقم بإرجاع 'type' إذا لم يكن موجودًا مسبقًا
            if (Schema::hasColumn('products', 'type')) {
                $table->string('type', 255)->change();
            }
    
            $table->string('description', 255)->change();
        });
    }
    
};
