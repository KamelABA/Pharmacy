<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // مسار ملف CSV داخل مجلد database/seeders/
        $csvFilePath = database_path('seeders/products.csv');

        if (!File::exists($csvFilePath)) {
            echo "❌ ملف CSV غير موجود: " . $csvFilePath;
            return;
        }

        // قراءة محتوى ملف CSV
        $csv = Reader::createFromPath($csvFilePath, 'r');
        $csv->setHeaderOffset(0); // تعيين أول صف كعناوين للأعمدة

        // تحويل كل صف إلى مصفوفة وإدراجها في قاعدة البيانات
        $records = $csv->getRecords();
        foreach ($records as $record) {
            DB::table('products')->insert([
                'id'          => $record['id'],
                'name'        => $record['name'],
                'description' => $record['description'],
                'price'       => $record['price'],
                'stock'       => $record['stock'],
                'created_at'  => $record['created_at'],
                'updated_at'  => $record['updated_at'],
            ]);
        }

        echo "✅ تم إدراج المنتجات من ملف CSV بنجاح!";
    }
}
