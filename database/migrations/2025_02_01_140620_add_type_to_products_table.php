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
        if (!Schema::hasColumn('products', 'type')) { // ✅ التأكد من عدم وجود العمود
            $table->string('type', 255)->nullable();
        }
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        if (Schema::hasColumn('products', 'type')) { // ✅ التحقق قبل الحذف
            $table->dropColumn('type');
        }
    });
}

};
