<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    public function run()
    {
        // مسار ملف CSV
        $filePath = database_path('seeders/user.csv');

        // التأكد من أن الملف موجود
        if (!File::exists($filePath)) {
            echo "❌ ملف CSV غير موجود في: $filePath\n";
            return;
        }

        // قراءة بيانات CSV
        $csvData = array_map('str_getcsv', file($filePath));

        // استخراج العناوين (header) وإزالتها من الصفوف
        $headers = array_shift($csvData);

        // تحويل بيانات CSV إلى مصفوفات مرتبطة (Associative Arrays)
        $users = [];
        foreach ($csvData as $row) {
            $users[] = array_combine($headers, $row);
        }

        // إدراج البيانات في قاعدة البيانات
        foreach ($users as $user) {
            DB::table('users')->insert([
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt($user['password']), // تشفير كلمة المرور
                'is_admin' => $user['is_admin'] ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            )
        }
    }
};